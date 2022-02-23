<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $customers = User::where('roles', '<>', 'ADMIN')->count();
        $revenue = Transaction::sum('total_price');
        $count_transactions = Transaction::count();
        return view('pages.admin.dashboard', [
            'user' => $customers,
            'revenue' => $revenue,
            'count_transaction' => $count_transactions
        ]);
    }
}
