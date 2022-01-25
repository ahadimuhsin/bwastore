<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreSettingsController extends Controller
{
    //
    public function store()
    {
        return view('pages.admin.store-settings.store');
    }

    public function account()
    {
        return view('pages.admin.store-settings.account');
    }
}
