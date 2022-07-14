<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('product', function($q){
            $q->where('users_id', auth()->id());
        });
        // dd($transactions->get());
        $revenue = $transactions->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();
        return view('pages.user.dashboard', [
            'transactions' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer
        ]);

    }



}
