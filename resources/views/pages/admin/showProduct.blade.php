@extends('layouts.adminDashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-4 mb-4 mb-lg-0" style="height: 200px;"">
                    <p style="font-weight: bold">Foto Produk</p>
                    <img style="height: 100%; width: 100%;
                    object-fit: contain; background-color: rgb(223, 223, 223)"
                        src="{{ asset('product_images/' . $product->image) }}" alt="Product Photo">

                </div>
                <div class="col-12 col-lg-8">
                    <p style="font-weight: bold">Nama Produk</p>
                    <h4 class="text-primary"><b>{{ $product->name }}</b></h4>
                    <hr>
                    <p style="font-weight: bold">Harga Produk</p>
                    <h4 class="text-primary">Rp <b>{{ number_format($product->price, 0, '', '.') }}</b> / kg</h4>
                    <hr>
                    <p style="font-weight: bold">Stok</p>
                    <h4 class="text-primary"><b>{{ $product->stock }}</b> kg</h4>
                    <hr>
                    <p style="font-weight: bold">Deskripsi Produk</p>
                    <p class="text-black">{{ $product->description }}</p>
                    <a class="btn btn-warning" href="{{ route('Admin.EditProduct', $product->id) }}"><i
                            class="fas fa-fw fa-pencil-alt"></i> Edit</a>
                </div>
            </div>

        </div>
    </div>
@endsection
