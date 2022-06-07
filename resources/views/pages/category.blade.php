@extends('layouts.app')

@section('title')
Category Page
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-categories">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
                </div>
            </div>
            <div class="row">
                @php
                $increment = 0;
                @endphp
                @forelse ($categories as $item)
                {{-- {{ $item->name }} --}}
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $increment +=100 }}">
                    <a class="component-categories d-block" href="{{ route('categories.detail', $item->slug) }}">
                        <div class="categories-image">
                            <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" class="w-100" />
                        </div>
                        <p class="categories-text">
                            {{ $item->name }}
                        </p>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    Kategori Kosong
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $item)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $increment +=100 }}">
                    <a class="component-products d-block" href="{{ route('detail', $item->slug) }}">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                            @if (count($item->galleries)>0)
                            background-image: url('{{ asset('storage/'.$item->galleries->first()->photo) }}')
                            @else
                            background-color: #eee
                            @endif
                  "></div>
                        </div>
                        <div class="products-text">
                            {{ $item->name }}
                        </div>
                        <div class="products-price">
                            ${{ $item->price }}
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    Produk Baru Kosong
                </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
