@extends('layouts.admin-dashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pesanan</h1>

    <div class="card shadow p-4 mb-4">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="{{ route('Admin.OrdersByStatus', 'waiting') }}"
                    class="btn btn-primary inline-block pb-3 {{ Route::current()->parameters['status'] === 'waiting' ? 'btn-success' : '' }}"
                    style="width: 100%">
                    <i class="bi bi-clock-fill" style="font-size: 36px"></i>
                    <br>
                    <span style="font-size: 15px; display:inline-block; margin-top: 10px">Menunggu</span>
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="{{ route('Admin.OrdersByStatus', 'accepted') }}"
                    class="btn btn-primary inline-block pb-3 {{ Route::current()->parameters['status'] === 'accepted' ? 'btn-success' : '' }}"
                    style="width: 100%">
                    <i class="bi bi-arrow-repeat" style="font-size: 36px"></i>
                    <br>
                    <span style="font-size: 15px; display:inline-block; margin-top: 10px">Diproses</span>
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="{{ route('Admin.OrdersByStatus', 'done') }}"
                    class="btn btn-primary inline-block pb-3 {{ Route::current()->parameters['status'] === 'done' ? 'btn-success' : '' }}"
                    style="width: 100%">
                    <i class="bi bi-check-circle-fill" style="font-size: 36px"></i>
                    <br>
                    <span style="font-size: 15px; display:inline-block; margin-top: 10px">Selesai</span>
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="{{ route('Admin.OrdersByStatus', 'canceled') }}"
                    class="btn btn-primary inline-block pb-3 {{ Route::current()->parameters['status'] === 'canceled' ? 'btn-success' : '' }}"
                    style="width: 100%">
                    <i class="bi bi-x-circle-fill" style="font-size: 36px"></i>
                    <br>
                    <span style="font-size: 15px; display:inline-block; margin-top: 10px">Dibatalkan</span>
                </a>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pesanan</h6>
            @if ($status == 'waiting')
                <h5 class="badge bg-warning text-white">
                    Menunggu konfirmasi
                </h5>
            @elseif ($status == 'accepted')
                <h5 class="badge bg-primary text-white">
                    Diproses
                </h5>
            @elseif ($status == 'canceled')
                <h5 class="badge bg-danger text-white">
                    Dibatalkan
                </h5>
            @else
                <h5 class="badge bg-success text-white">
                    Selesai
                </h5>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="productTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pemesan</th>
                            <th>Produk</th>
                            <th>Total harga</th>
                            <th>Tanggal pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ ($orders->currentpage() - 1) * $orders->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($order->order_items as $item)
                                            @if (!is_null($item->product))
                                                <li>{{ $item->product->name }} ({{ $item->quantity }}
                                                    krat)
                                                </li>
                                            @else
                                                <li>{{ $item->product_name }} ({{ $item->quantity }}
                                                    krat)
                                                    <p class="badge bg-danger text-white">Produk terhapus</p>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, '', '.') }}</td>
                                <td>{{ Carbon\Carbon::parse($order->created_at)->addHours(7)->translatedFormat('d F Y H:i') }}
                                </td>
                                <td>
                                    @if ($order->status == 'waiting')
                                        <form action="{{ route('Admin.AcceptOrder', [$order->id, 'accepted']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success mb-3 w-100">Terima</button>
                                        </form>
                                        <form action="{{ route('Admin.CancelOrder', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">Batalkan</button>
                                        </form>
                                    @elseif ($order->status == 'accepted')
                                        <h5 class="badge bg-success text-white">
                                            Menunggu pembayaran
                                        </h5>
                                    @elseif ($order->status == 'canceled')
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'waiting']) }}"
                                            method="POST">
                                            @csrf
                                            -
                                            {{-- <button type="submit" class="btn btn-warning mb-3 w-100">Pindah ke
                                                menunggu</button> --}}
                                        </form>
                                    @else
                                        <h5 class="badge bg-success text-white">
                                            Selesai
                                        </h5>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
