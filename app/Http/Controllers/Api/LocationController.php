<?php

namespace App\Http\Controllers\Api;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Regency;

class LocationController extends Controller
{
    public function provinsi(Request $request)
    {
        // return response()->json(Province::all(), 200);
        return Province::all();
    }

    public function kota($id_provinsi)
    {
        // return response()->json(Regency::where('province_id', $id_provinsi)->get(), '200');
        return Regency::where('province_id', $id_provinsi)->get();
    }
}
