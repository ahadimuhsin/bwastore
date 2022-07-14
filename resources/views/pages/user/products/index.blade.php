@extends('layouts.dashboard')

@section('title')
Products
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Products</h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-success">Add New Product</a>
                </div>
            </div>
            <div class="row mt-4">
                @foreach ($my_products as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a class="card card-dashboard-product d-block" href="{{ route('dashboard.products.details', $item->id) }}">
                        <div class="card-body">
                            <img src="{{ $item->galleries->first()->photo ? asset('storage/'.$item->galleries->first()->photo) :'https://www.indonesiapower.co.id/SiteAssets/image-not-found.png' }}" alt=""
                            class="mb-2 img-fluid" style="width:200px;height:100px;object-fit: cover;" />
                            <div class="product-title">{{ $item->name }}</div>
                            <div class="product-category">{{ $item->nama_kategori }}</div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
