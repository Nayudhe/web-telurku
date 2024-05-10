@extends('layouts.mainLayout')

@section('body')
    <div>
        <h1>Kotak Saran</h1>
        <p style="font-size: 18px;">Hubungi kami melalui kontak di bawah ini jika ada pertanyaan ataupun kritik dan saran.</p>

        <div class="mt-5 row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card p-4 shadow me-md-4">
                    <div class="d-flex flex-column">
                        <h5 style="color: #508bfc"><i class="bi bi-geo-fill"></i></h5>
                        <h5 class="fw-normal" style="font-size: 18px">Alamat</h5>
                        <h5 class="mb-3">Jl. Mawar RT 002/RW 001 Ds. Sukomoro, Kecamatan Papar, Kabupaten Kediri</h5>
                        <a href="https://maps.app.goo.gl/pLFSoGfwCGHztBkn8" target="_blank" class="btn btn-primary">Buka di Google Maps</a>
                    </div>
                    <hr>
                    <div class="d-flex flex-column">
                        <h5 style="color: #508bfc"><i class="bi bi-telephone-fill"></i></h5>
                        <h5 class="fw-normal" style="font-size: 18px">No. Telepon</h5>
                        <h5 class="mb-3">0858-5497-9026</h5>
                        <a href="https://wa.me/6285854879026" target="_blank" class="btn btn-primary">Hubungi via Whatsapp</a>
                    </div>
                    <hr>
                    <div class="d-flex flex-column">
                        <h5 style="color: #508bfc"><i class="bi bi-envelope-fill"></i></h5>
                        <h5 class="fw-normal" style="font-size: 18px">Email</h5>
                        <h5>andrijayatelur@gmail.com</h5>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('SendMessage') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputContactName" class="form-label">Nama anda</label>
                        <input name="name" type="text" class="form-control form-control-lg shadow-sm"
                            id="inputContactName" placeholder="Nama anda">
                        @if ($errors->has('name'))
                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="inputContactEmail" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control form-control-lg shadow-sm"
                            id="inputContactEmail" placeholder="nama@email.com">
                        @if ($errors->has('email'))
                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="inputContactMessage" class="form-label">Pesan</label>
                        <textarea name="message" class="form-control form-control-lg shadow-sm" id="inputContactMessage" rows="7"></textarea>
                        @if ($errors->has('message'))
                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                {{ $errors->first('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="ms-auto btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
