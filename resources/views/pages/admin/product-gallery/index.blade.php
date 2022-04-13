@extends('layouts.admin')

@section('title')
Product Gallery
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Gallery</h2>
            <p class="dashboard-subtitle">
                List Of Gallery
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('product-galleries.create') }}" class="btn btn-primary mb-3">
                            + Tambah Galeri Baru</a>

                            <div class="table-responsive">
                                <table class="table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
<script>
    let dataTable = $("#crudTable").DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'photo', name: 'photo'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "15%"
            },
        ]
    });
</script>
@endpush
