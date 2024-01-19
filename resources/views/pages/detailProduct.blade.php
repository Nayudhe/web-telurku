@extends('layouts.mainLayout')

@section('body')
    <h3 class="mb-4">Detail Produk</h3>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-5 mb-4 mb-md-0" style="height: 450px;">
            <img src="{{ asset('img/egg-default.jpg') }}" alt="..."
                style="height: 100%; width: 100%; object-fit: contain; background-color: rgb(223, 223, 223)">
        </div>

        <div class="col">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <div class="badge bg-secondary p-2 mb-4">
                <p class="mb-0" style="font-size: 14px">Sisa stok: {{ $product->stock }} kg</p>
            </div>
            <p class="text-success mb-4 fs-3 fw-bold">Rp {{ number_format($product->price, 0, '', '.') }} / kg</p>

            <hr>
            <p>Masukkan ke keranjang:</p>
            <div class="input-group mb-3" style="max-width: 200px">
                <input type="number" min="1" class="form-control" placeholder="Jumlah" aria-label="Jumlah"
                    aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">kg</span>
            </div>
            <button class="btn btn-success" style="padding-bottom: 11px"><i class="bi bi-cart-plus fs-5"></i></button>
        </div>
    </div>
@endsection
