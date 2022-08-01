<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class StoreSettingsController extends Controller
{
    //
    public function store()
    {
        $user = auth()->user();
        $categories = DB::table('categories')->get();
        return view('pages.user.store-settings.store', compact('user', 'categories'));
    }

    public function account()
    {
        $user = auth()->user();
        $provinsi = Province::get();
        return view('pages.user.store-settings.account', compact('user'));
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = auth()->user();
        $item->update($data);

        Alert::success('Sukses', 'Update Pengaturan Toko Berhasil');

        return redirect()->route($redirect);
    }
}
