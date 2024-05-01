@extends('layouts.mainLayout')

@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-EPEiXdpH3egHGUKU"></script>
@endsection

@section('body')
    <div>
        <h1>Pembayaran</h1>
        <hr>
        <div class="row">
            <div class="card p-4">
                <h5 class="mb-3">{{ count($order->order_items) }} item</h5>
                @foreach ($order->order_items as $item)
                    <div class="card p-2 mb-3 w-100" id="cardId{{ $item->id }}">
                        <div class="row">
                            <div class="col-6 col-md-5">
                                <div class="d-flex gap-3">
                                    <div style="height: 90px; width: 90px; flex-shrink: 0">
                                        <img src="{{ asset('product_images/' . $item->product->image) }}" alt=""
                                            class="w-100 h-100"
                                            style="object-fit: contain; background-color: rgb(223, 223, 223)">
                                    </div>
                                    <div>
                                        <h5 class="mb-2">{{ $item->product->name }}</h5>
                                        <p class="badge bg-secondary mb-0">{{ $item->quantity }} krat</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-7">
                                <div class="d-flex gap-3 justify-content-end">
                                    <div>
                                        <p class="mb-1">Harga</p>
                                        <p class="fw-bold" style="font-size: 18px; color: rgb(39, 163, 111)"">Rp
                                            {{ number_format($item->quantity * $item->product->price, 0, '', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="me-2 d-flex flex-column align-items-end">
                    <h5>Subtotal: Rp {{ number_format($total_price, 0, '', '.') }}</h5>
                    <h5>Biaya pengiriman: Rp {{ number_format(20000, 0, '', '.') }}</h5>
                    @if ($order->order_items->sum('quantity') >= 20)
                        <h5 class="text-danger">Diskon: - Rp {{ number_format(15000, 0, '', '.') }}</h5>
                    @endif

                    <hr class="w-100">
                    @if ($order->order_items->sum('quantity') >= 20)
                        <h5>Total: Rp {{ number_format($total_price + 5000, 0, '', '.') }}</h5>
                    @else
                        <h5>Total: Rp {{ number_format($total_price + 20000, 0, '', '.') }}</h5>
                    @endif
                </div>
                <div class="d-flex justify-content-end">
                    <input type="hidden" value="{{ $order->snap_token }}" id="snap-token">
                    <input type="hidden" value="{{ $order->id }}" id="order-id">
                    <input type="hidden" name="_token" value="value="{{ Session::token() }}" id="order-id">
                    <button class="mt-3 btn btn-primary inline-block" id="pay-button">Bayar sekarang</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script async>
        const snapToken = document.querySelector('#snap-token').value;
        const payButton = document.querySelector('#pay-button');
        const orderId = document.querySelector('#order-id').value;

        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    fetch(`/checkout/status/${orderId}/done/2`, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        method: "POST",
                        credentials: "same-origin"
                    }).then(res => {
                        document.location.href = "{{ route('Orders') }}";
                    })
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    document.location.href = "{{ route('Orders') }}";
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                // onClose: function() {
                //     /* You may add your own implementation here */
                //     alert('you closed the popup without finishing the payment');
                //     document.location.href = "{{ route('Orders') }}";
                // }
            })
        });
    </script>
@endsection
