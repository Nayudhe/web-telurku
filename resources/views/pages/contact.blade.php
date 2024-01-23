@extends('layouts.mainLayout')

@section('body')
    <div>
        <h1>Kontak Kami</h1>
        <p>Hubungi kami melalui kontak di bawah ini jika ada pertanyaan ataupun kritik dan saran.</p>

        <div class="mt-5 row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card p-4 shadow me-md-4">
                    <div class="d-flex flex-column">
                        <h5 style="color: #508bfc"><i class="bi bi-geo-fill"></i></h5>
                        <h5 class="fw-normal" style="font-size: 18px">Alamat</h5>
                        <h5>Kediri</h5>
                    </div>
                    <hr>
                    <div class="d-flex flex-column">
                        <h5 style="color: #508bfc"><i class="bi bi-telephone-fill"></i></h5>
                        <h5 class="fw-normal" style="font-size: 18px">No. Telepon</h5>
                        <h5>0858-5497-9026</h5>
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
                        {{ session('status') }}sdadsad
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
