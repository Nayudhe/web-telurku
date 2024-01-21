@extends('layouts.mainLayout')

@section('body')
    <div>
        <div class="d-flex flex-column align-items-center" style="margin-bottom: 24px">
            <h1>Produk Kami</h1>
            <p>Temukan berbagai macam produk telur kami yang tersedia.</p>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('Product.Detail', $product->id) }}" style="text-decoration: none">
                        <div class="card shadow mb-4">
                            <img src="{{ asset('img/egg-default.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title mb-0">
                                    {{ $product->name }}
                                </h5>
                            </div>
                            <div class="card-footer">
                                <p class="text-success mb-0 fw-semibold">Rp {{ number_format($product->price, 0, '', '.') }}
                                    / kg
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
@endsection
