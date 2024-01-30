@extends('layouts.mainLayout')

@section('body')
    <h1>Keranjang</h1>
    <hr class="mb-4">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <i class="bi bi-exclamation-circle me-2"></i>
            @if ($errors->has('cart_item_id'))
                Mohon pilih barang yang akan di-checkout terlebih dahulu.
            @else
                Mohon maaf terjadi kesalahan, silakan ulangi kembali.
            @endif
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-8 order-2 order-lg-1">
            @if (count($cart_items) > 0)
                @foreach ($cart_items as $item)
                    <div class="d-flex align-items-center gap-2">
                        <div class="form-check">
                            <input autocomplete="off" onclick="checkOnClick(this)" value="{{ $item->id }}"
                                data-price="{{ $item->total_price }}"
                                class="form-check-input border border-3 border-primary" type="checkbox" value=""
                                id="cbox{{ $item->id }}">
                        </div>
                        <div class="card p-2 mb-3 w-100" id="cardId{{ $item->id }}" style="--bs-bg-opacity: .3;">
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
                                    <div class="d-flex gap-3 justify-content-between">
                                        <div>
                                            <p class="mb-1">Harga</p>
                                            <p class="fw-bold" style="font-size: 18px; color: rgb(39, 163, 111)"">Rp
                                                {{ number_format($item->total_price, 0, '', '.') }}</p>
                                        </div>
                                        <div>
                                            <button id="btnDelete{{ $item->id }}" type="button"
                                                class="btnDelete btn btn-danger" data-name="{{ $item->product->name }}"
                                                data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"><i class="bi bi-trash-fill me-md-2"></i><span
                                                    class="d-none d-md-inline">
                                                    Hapus</span></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-4">
                    <h2 style="color: rgb(188, 188, 188)">Tidak ada barang di keranjang</h2>
                    <a class="btn btn-primary" href="{{ route('Product.All') }}">Ke halaman produk <i
                            class="bi bi-arrow-right"></i></a>
                </div>
            @endif
        </div>
        <div class="col-12 col-lg-4 order-1 order-lg-2 mb-4 mb-lg-0">
            <div class="card p-3 shadow">
                <h4>Pesanan anda</h4>
                <p><span id="selectedCount">0</span> produk dipilih</p>
                <p class="mb-2">Total harga:</p>
                <p class="fw-bold fs-5">Rp <span id="selectedTotalPrice" data-value="0">0</span></p>

                <form action="{{ route('Cart.Checkout') }}" method="POST">
                    @csrf
                    <div id="insertinputs">
                    </div>
                    <button type="submit"
                        class="btn btn-success @if (count($cart_items) < 1) disabled @endif ">Checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="modalDeleteForm" style="display: inline" method="POST" action="">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" async>
        function checkOnClick(checkbox) {
            const currentPrice = Number(document.getElementById("selectedTotalPrice").dataset.value);
            if (checkbox.checked) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "cart_item_id[]"
                input.value = checkbox.value;
                input.id = "inputItem" + checkbox.value;
                document.getElementById("insertinputs").appendChild(input);
                document.getElementById("cardId" + checkbox.value).classList.add('bg-primary');
                document.getElementById("btnDelete" + checkbox.value).classList.add('disabled');

                const updatedPrice = currentPrice + Number(checkbox.dataset.price);
                document.getElementById("selectedTotalPrice").dataset.value = updatedPrice;
                document.getElementById("selectedTotalPrice").innerText = updatedPrice.toLocaleString()
            } else {
                document.getElementById("inputItem" + checkbox.value).remove();
                document.getElementById("cardId" + checkbox.value).classList.remove('bg-primary');
                document.getElementById("btnDelete" + checkbox.value).classList.remove('disabled');

                const updatedPrice = currentPrice - Number(checkbox.dataset.price);
                document.getElementById("selectedTotalPrice").dataset.value = updatedPrice;
                document.getElementById("selectedTotalPrice").innerText = updatedPrice.toLocaleString()
            }
            const count = document.getElementById("insertinputs").childElementCount;
            document.getElementById("selectedCount").innerText = count;
        }

        $(document).ready(function() {
            const form = $('#modalDeleteForm')
            const modalBody = $('#deleteModal > .modal-dialog > .modal-content > .modal-body')
            $('.btnDelete').on('click', function() {
                const cartId = $(this).data('id')
                const productName = $(this).data('name')

                modalBody.html(
                    `Apakah anda yakin ingin menghapus produk <b>${productName}</b> dari keranjang?`)
                form.attr('action', `/cart/${cartId}`)
            })
        });
    </script>
@endsection
