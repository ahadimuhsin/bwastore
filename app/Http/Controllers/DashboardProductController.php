<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    //
    public function index()
    {
        return view('pages.user.products.index');
    }

    public function create()
    {
        return view('pages.user.products.create');
    }

    public function show()
    {
        return view('pages.user.products.details');
    }
}
