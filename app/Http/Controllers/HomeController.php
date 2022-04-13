<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::table('categories')->take(6)->get();
        // dd($categories);
        $products = Product::with('galleries')->take(8)->get();
        // dd($products);
        return view('pages.home', compact('categories', 'products'));
    }
}
