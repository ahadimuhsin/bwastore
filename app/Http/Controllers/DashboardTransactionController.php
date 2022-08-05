<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class DashboardTransactionController extends Controller
{
    //
    public function index()
    {
        $sell_transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('product', function($q){
            $q->where('users_id', auth()->id());
        })->get();

        $buy_transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('transaction', function($q){
            $q->where('users_id', auth()->id());
        })->get();

        return view('pages.user.transactions.index', compact('sell_transactions', 'buy_transactions'));
    }

    public function show(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->findOrFail($id);

        return view('pages.user.transactions.details', compact('transaction'));
    }

    public function updateResi(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);

        return redirect()->route('dashboard.transactions.details', $id);
    }
}
