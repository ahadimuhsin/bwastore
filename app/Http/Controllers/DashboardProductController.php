<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;

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
        $categories = DB::table('categories')->get();
        return view('pages.user.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name'], '-');
        $product = Product::create($data);
        $gallery = [
            'products_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);
        return redirect()->route('dashboard.products');
    }

    public function show($id)
    {
        $my_product = Product::with(['galleries','user', 'category'])->findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('pages.user.products.details', compact('my_product', 'categories'));
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['file'] = $request->file('photo')->store('assets/product', 'public');
        ProductGallery::create([
            'photo' => $data['file'],
            'products_id' => $data['products_id']
        ]);

        return redirect()->route('dashboard.products.details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $product = ProductGallery::findOrFail($id);
        // dd($request->all());
        Storage::disk('local')->delete('public/assets/product/'.$product->photo);
        $product->delete();
        return redirect()->route('dashboard.products.details', $product->products_id);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();

        $product = Product::findOrFail($id);

        $data['slug'] = Str::slug($data['name'], '-');

        $product->update($data);

        return redirect()->route('dashboard.products');
    }
}
