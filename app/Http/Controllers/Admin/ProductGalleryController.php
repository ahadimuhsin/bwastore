<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductGalleryRequest;

class ProductGalleryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {

            $query = DB::table("product_galleries AS a")
            ->selectRaw('a.*, b.name')
            ->join("products AS b", "b.id", "=", "a.products_id")
            ->latest();

            // dd($query->id);

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
                            <form action="'.route('product-galleries.destroy', $item->id).'" method="POST">
                               '.csrf_field() .method_field('delete').'
                               <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })
            ->editColumn('photo', function($item){
                return $item->photo ? '<img src="'.Storage::url($item->photo).'" style="max-height: 80px">'
                : '';
            })
            ->rawColumns(['action', 'photo'])
            ->make();

        }
        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('pages.admin.product-gallery.create', compact('products'));
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
        $data['file'] = $request->file('file')->store('assets/product', 'public');
        ProductGallery::create([
            'photo' => $data['file'],
            'products_id' => $data['id_produk']
        ]);

        return redirect()->route('product-galleries.index');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductGallery::findOrFail($id);
        Storage::disk('local')->delete('public/assets/product/'.$product->photo);
        $product->delete();
        // dd($product);
        return redirect()->route('product-galleries.index');
    }
}
