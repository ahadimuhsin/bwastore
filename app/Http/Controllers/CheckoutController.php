<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function process(Request $request)
    {
        //save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $code = 'STORE-'.mt_rand(0000,9999);
        $carts = Cart::with(['product', 'user'])
        ->where('users_id', auth()->id())
        ->get();

        // DB::beginTransaction();

        // try {
            # code...
            //create transaction
        $transaction = Transaction::create([
            'users_id' => auth()->id(),
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach($carts as $cart)
        {
            $trx = 'TRX-'.mt_rand(0000,9999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        //delet cart data
        Cart::with(['product', 'user'])
        ->where('users_id', auth()->id())->delete();

        //konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.is_production');
            // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.is_sanitized');
            // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is_3ds');

        $params =
            [
                'transaction_details' =>[
                    'order_id' => $code,
                    'gross_amount' => (int) $request->total_price,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone_number
                ],
                'enabled_payments' => [
                    "gopay", "permata_va", "bank_transfer"
                ],
                'vtweb' => []
            ];
            try {
                // Get Snap Payment Page URL
                $paymentUrl = Snap::createTransaction($params)->redirect_url;

                // Redirect to Snap Payment Page
                return redirect($paymentUrl);
                // header('Location: ' . $paymentUrl);
              }
              catch (Exception $e) {
                echo $e->getMessage();
              }

        DB::commit();
        // } catch (Exception $e) {
        //     # code...
        //     echo $e->getMessage();
        //     DB::rollback();
        // }

    }

    function callback(Request $request)
    {
        //set konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.is_production');
            // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.is_sanitized');
            // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is_3ds');

        //instance midtrans notification
        $notification = new Notification();

        //assign ke variabel untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        //cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        //handle notification status
        if($status == 'capture'){
            if($type == "credit_card"){
                if($fraud == "challenge"){
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if ($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }
        else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();

        // Kirimkan email
        if ($transaction)
        {
            if($status == 'capture' && $fraud == 'accept' )
            {
                //
            }
            else if ($status == 'settlement')
            {
                //
            }
            else if ($status == 'success')
            {
                //
            }
            else if($status == 'capture' && $fraud == 'challenge' )
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }
            else
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
    }
}
