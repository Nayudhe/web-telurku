@extends('layouts.mainLayout')

@section('body')
    <h1 class="mb-5">Profil Saya</h1>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card p-4 shadow-sm rounded-3 mb-3">
                <div class="mb-3">
                    <p class="mb-2">Nama</p>
                    <h5>
                        {{ $user->name }}

                        @if ($user->role == 'admin')
                            <span class="ms-2 badge bg-primary">ADMIN</span>
                        @endif
                    </h5>
                </div>
                <div class="mb-3">
                    <p class="mb-2">Email</p>
                    <h5>{{ $user->email }}</h5>
                </div>
                <div>
                    <p class="mb-2">Tanggal dibuat</p>
                    <h5> {{ Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y h:m') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card p-4 shadow-sm rounded-3 mb-3">
                <h5 class="mb-4">Statistik Pesanan</h5>
                <div>
                    <p class="mb-2">Jumlah pesanan selesai</p>
                    <h5>{{ count($user->orders->where('status', 'done')) }}</h5>
                </div>
                <hr>
                <div>
                    <p class="mb-2">Total pengeluaran</p>
                    <h5>Rp {{ number_format($user->orders->where('status', 'done')->sum('total_price'), 0, '', '.') }}</h5>
                </div>
            </div>


        </div>
    @endsection
