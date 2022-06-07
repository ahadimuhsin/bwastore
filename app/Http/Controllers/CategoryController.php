<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        $products = Product::with('galleries')->paginate(8);
        // dd($products);
        return view('pages.category', compact('categories', 'products'));
    }

    public function detail(Request $request, $slug)
    {
        $categories = DB::table('categories')->get();
        $category = DB::table('categories')->where('slug', $slug)->first();
        $products = Product::with('galleries')->where('categories_id', $category->id)->paginate(8);
        // dd($products);
        return view('pages.category', compact('categories', 'products'));
    }
}
