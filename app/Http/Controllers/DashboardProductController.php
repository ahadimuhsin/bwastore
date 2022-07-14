<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    //
    public function index()
    {
        $my_products = Product::select('products.*', 'cat.name as nama_kategori', 'cat.slug as slug_kategori')->with(['galleries'])
        ->join('categories as cat', 'cat.id', '=', 'products.categories_id')
        ->where('users_id', auth()->id())
        ->get();
        // dd($my_products);
        return view('pages.user.products.index', compact('my_products'));
    }

    public function create()
    {
        $categories = \DB::table('categories')->get();
        return view('pages.user.products.create', compact('categories'));
    }

    public function show($id)
    {
        $my_product = Product::with(['galleries'])->findOrFail($id);
        return view('pages.user.products.details', compact('my_product'));
    }
}
