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
