@extends('layouts.mainLayout')

@section('body')
    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded-3">
            <div class="carousel-item active">
                <div style="height: 450px; width: 100%">
                    <img src="{{ asset('img/egg-default.jpg') }}" class="d-block h-100 w-100" alt="..."
                        style="object-fit: cover; object-position: center">
                </div>
            </div>
            <div class="carousel-item">
                <div style="height: 450px; width: 100%">
                    <img src="{{ asset('img/egg-default.jpg') }}" class="d-block h-100 w-100" alt="..."
                        style="object-fit: cover; object-position: center">
                </div>
            </div>
            <div class="carousel-item">
                <div style="height: 450px; width: 100%">
                    <img src="{{ asset('img/egg-default.jpg') }}" class="d-block h-100 w-100" alt="..."
                        style="object-fit: cover; object-position: center">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle"
                style="width: 45px; height: 45px"><span class="me-1 carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </div>

        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <div class="d-flex justify-content-center align-items-center bg-secondary rounded-circle"
                style="width: 45px; height: 45px">
                <span class="ms-1 carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </div>
        </button>
    </div>

    <div class="mb-5 py-5">
        <h2 class="mb-4">Tentang Kami</h2>
        <div class="row">
            <div class="col-12 col-md-5 mb-4 mb-md-0">
                <div style="height: 300px">
                    <img class="h-100 w-100" style="object-fit: cover; object-position: center"
                        src="{{ asset('img/egg-default.jpg') }}" alt="...">
                </div>
            </div>
            <div class="col">
                <p style="font-size: 18px; text-align: justify">Andri Jaya Telor merupakan usaha dagang (UD) merupakan
                    peternakan telur ayam negeri yang telah berkomitmen untuk memberikan produk berkualitas tinggi kepada
                    pelanggan kami sejak awal berdiri. Kami
                    menghargai kepercayaan pelanggan kami dan berkomitmen untuk terus meningkatkan proses produksi kami demi
                    memberikan produk terbaik. Dengan standar kualitas yang kami miliki, kami memastikan setiap telur yang
                    dihasilkan tidak hanya lezat, tetapi juga
                    aman untuk dikonsumsi.</p>
            </div>
        </div>
    </div>

    <div class="mb-5 pb-5">
        <h2 class="mb-4">Produk Unggulan</h2>
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
        <div class="d-flex justify-content-end">
            <a href="{{ route('Product.All') }}" class="btn btn-primary">Lihat semua produk <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center">
        <h2>Hubungi Kami</h2>
        <p>Anda punya pertanyaan atau masukan? hubungi kami kapanpun!</p>

        <div class="mt-4 pb-5 row w-100 justify-content-center">
            <div class="col-12 col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="inputContactName" class="form-label">Nama anda</label>
                        <input type="email" class="form-control form-control-lg shadow-sm" id="inputContactName"
                            placeholder="Nama anda">
                    </div>
                    <div class="mb-3">
                        <label for="inputContactEmail" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg shadow-sm" id="inputContactEmail"
                            placeholder="nama@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="inputContactMessage" class="form-label">Pesan</label>
                        <textarea class="form-control form-control-lg shadow-sm" id="inputContactMessage" rows="7"></textarea>
                    </div>
                    <div class="d-flex">
                        <button class="ms-auto btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
