@extends('layouts.adminDashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pesanan</h1>

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
                                            <li>{{ $item->product->name }} ({{ $item->quantity }} kg)</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, '', '.') }}</td>
                                <td>{{ Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y h:m') }}</td>
                                <td>
                                    @if ($order->status == 'waiting')
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'accepted']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success mb-3 w-100">Terima</button>
                                        </form>
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'canceled']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">Batalkan</button>
                                        </form>
                                    @elseif ($order->status == 'accepted')
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'done']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success mb-3 w-100">Selesaikan</button>
                                        </form>
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'canceled']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">Batalkan</button>
                                        </form>
                                    @elseif ($order->status == 'canceled')
                                        <form action="{{ route('Admin.StatusOrder', [$order->id, 'waiting']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning mb-3 w-100">Pindah ke
                                                menunggu</button>
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
