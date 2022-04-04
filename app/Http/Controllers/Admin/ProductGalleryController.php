<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductGalleryRequest;

class ProductGalleryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {

            $query = ProductGallery::with('product');

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button"
                        data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.route('products.edit', $item->id).'">
                                Sunting
                            </a>
                            <form action="'.route('products.destroy', $item->id).'" method="POST">
                               '.csrf_field() .method_field('delete').'
                               <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();

        }
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        // $categories = DB::table('categories')->get();
        // dd($categories);
        return view('pages.admin.product.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name'], '-');
        Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        // dd(Product::findOrFail($id));
        $product = Product::findOrFail($id);
        $users = User::get();
        $categories = DB::table('categories')->get();
        // dd($product);
        return view('pages.admin.product.edit', compact('product', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();

        $product = Product::findOrFail($id);

        $data['slug'] = Str::slug($data['name'], '-');

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Storage::disk('local')->delete('public/assets/product/'.$product->photo);
        $product->delete();
        // dd($product);
        return redirect()->route('products.index');
    }
}
