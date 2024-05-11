@extends('layouts.mainLayout')

@section('body')
    <h1 class="mb-5">Pesanan saya</h1>
    @if (count($orders) > 0)
        @foreach ($orders as $order)
            <div class="card p-3 shadow-sm rounded-3 mb-3">
                <div class="row gap-4 justify-content-between">
                    <div class="col-3">
                        <p class="mb-2">Tanggal</p>
                        <h5>{{ Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                            <span class="ms-1 p-1 rounded-1 bg-success" style="--bs-bg-opacity: .3;">
                                {{ Carbon\Carbon::parse($order->created_at)->addHours(7)->translatedFormat('H:i:s') }}
                            </span>
                        </h5>
                    </div>
                    <div class="col-3">
                        <p class="mb-2">Produk</p>
                        <ul class="m-0">
                            @foreach ($order->order_items as $item)
                                <li>{{ $item->product_name }} ({{ $item->quantity }} krat)</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <p class="mb-2">Status</p>

                        @if ($order->status == 'waiting')
                            <h5 class="badge bg-warning">
                                Menunggu konfirmasi
                            </h5>
                        @elseif ($order->status == 'accepted')
                            <h5 class="badge bg-primary">
                                Menunggu pembayaran
                            </h5>
                        @elseif ($order->status == 'canceled')
                            <h5 class="badge bg-danger">
                                Dibatalkan
                            </h5>
                        @else
                            <h5 class="badge bg-success">
                                Selesai
                            </h5>
                        @endif
                        </h5>
                    </div>
                    <div class="col d-flex align-items-center">
                        @if ($order->status == 'accepted')
                            @if ($order->payment_status == '1')
                                <form action="{{ route('Checkout.Payment', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Bayar sekarang
                                    </button>
                                </form>
                            @elseif ($order->payment_status == '2')
                                <h5 class="badge bg-success">
                                    Sudah dibayar
                                </h5>
                            @elseif ($order->payment_status == '3')
                                <h5 class="badge bg-warning">
                                    Pembayaran kadaluarsa
                                </h5>
                            @endif
                        @endif
                    </div>
                    <div class="col">
                        <p class="mb-2">Total</p>
                        <h5>Rp {{ number_format($order->total_price, 0, '', '.') }}</h5>
                    </div>


                </div>
            </div>
        @endforeach
    @else
        <div class="mt-4">
            <h2 style="color: rgb(188, 188, 188)">Belum ada barang yang dipesan</h2>
            <a class="btn btn-primary" href="{{ route('Product.All') }}">Ke halaman produk <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    @endif
@endsection
