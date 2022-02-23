<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    //
    public function index()
    {
        return view('pages.user.transactions.index');
    }

    public function show()
    {
        return view('pages.user.transactions.details');
    }
}
