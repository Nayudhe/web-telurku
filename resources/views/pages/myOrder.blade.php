@extends('layouts.mainLayout')

@section('body')
    <h1 class="mb-5">Pesanan saya</h1>
    @foreach ($orders as $order)
        <div class="card px-3 py-2 shadow-sm rounded-4 mb-3">
            <div class="d-flex flex-wrap gap-4 justify-content-between">
                <div>
                    <p class="mb-2">Tanggal</p>
                    <h5>{{ Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                        <span class="ms-1 p-1 rounded-1 bg-success" style="--bs-bg-opacity: .3;">
                            {{ Carbon\Carbon::parse($order->created_at)->translatedFormat('h:m') }}
                        </span>
                    </h5>
                </div>
                <div>
                    <p class="mb-2">Produk</p>
                    <ul class="m-0">
                        @foreach ($order->order_items as $item)
                            <li>{{ $item->product->name }} ({{ $item->quantity }} kg)</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <p class="mb-2">Status</p>

                    @if ($order->status == 'waiting')
                        <h5 class="badge bg-warning">
                            Menunggu konfirmasi
                        </h5>
                    @elseif ($order->status == 'accepted')
                        <h5 class="badge bg-primary">
                            Diproses
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
                <div>
                    <p class="mb-2">Total</p>
                    <h5>Rp {{ number_format($order->total_price, 0, '', '.') }}</h5>
                </div>
            </div>
        </div>
    @endforeach
@endsection
