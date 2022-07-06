<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $slug)
    {
        $product = Product::with(['galleries', 'user'])
        ->where('slug', $slug)->firstOrFail();
        // dd($product->galleries);
        return view('pages.detail', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => auth()->id(),
        ];
        Cart::create($data);
        return redirect()->route('cart');
    }
}
