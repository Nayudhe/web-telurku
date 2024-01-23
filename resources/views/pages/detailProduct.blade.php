@extends('layouts.mainLayout')

@section('body')
    <h3 class="mb-4">Detail Produk</h3>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-5 mb-4 mb-md-0" style="height: 450px;">
            <img src="{{ asset('product_images/' . $product->image) }}" alt="..."
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
            <form action="{{ route('Cart.Add') }}" method="POST">
                @csrf
                <div class="input-group mb-3" style="max-width: 200px">
                    <input name="quantity" type="number" min="1" max="{{ $product->stock }}" class="form-control"
                        placeholder="Jumlah" aria-label="Jumlah" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-success" style="padding-bottom: 11px"><i
                        class="bi bi-cart-plus fs-5"></i></button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    @if ($errors->has('quantity'))
                        Mohon masukkan jumlah barang terlebih dahulu
                    @else
                        Mohon maaf terjadi kesalahan, silakan ulangi kembali.
                    @endif
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success mt-4"> {{ \Session::get('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
