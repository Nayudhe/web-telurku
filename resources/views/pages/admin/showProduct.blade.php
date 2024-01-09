@extends('layouts.adminDashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
        </div>
        <div class="card-body">
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
        </div>
    </div>
@endsection
