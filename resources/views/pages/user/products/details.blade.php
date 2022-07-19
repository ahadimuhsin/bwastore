@extends('layouts.dashboard')

@section('title')
Products
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $my_product->name }}</h2>
            <p class="dashboard-subtitle">
                Product Details
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>$error</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard.products.update', $my_product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="hidden" name="users_id" value="{{ auth()->id() }}">
                                            <input type="text" class="form-control" id="name" aria-describedby="name"
                                                name="name" value="{{ $my_product->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price ($)</label>
                                            <input type="number" class="form-control" id="price"
                                                aria-describedby="price" name="price" value="{{ $my_product->price }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categorie">Categories</label>
                                            <select name="categories_id" id="categories_id" class="form-control">
                                                <option value="" disabled>Pilih Kategori</option>
                                                @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ $my_product->categories_id === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="4" class="form-control">{!! $my_product->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-success btn-block px-5">
                                            Update Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                @foreach ($my_product->galleries as $item)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="{{ Storage::url($item->photo ?? '') }}" alt="" class="w-100" />
                                        <a href="{{ route('dashboard.products.delete-gallery', $item->id) }}" class="delete-gallery">
                                            <img src="/images/icon-delete.svg" alt="" />
                                          </a>
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-12 mt-3">
                                    <form action="{{ route('dashboard.products.upload-gallery') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="products_id" value="{{ $my_product->id }}">
                                    <input type="file" id="file" name="photo" style="display: none;" multiple onchange="form.submit()"/>
                                    <button class="btn btn-secondary btn-block" onclick="thisFileUpload();" type="button">
                                        Add Photo
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    function thisFileUpload() {
        document.getElementById("file").click();
      }
</script>
<script>
    CKEDITOR.replace("description")
</script>
@endpush
