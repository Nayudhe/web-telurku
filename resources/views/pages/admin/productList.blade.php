@extends('layouts.adminDashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Produk</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="productTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga (per kg)</th>
                            <th>Stok (kg)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, '', '.') }} / kg</td>
                                <td>{{ $product->stock }} kg</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('Admin.ShowProduct', $product->id) }}">Detail</a>
                                    <a class="btn btn-warning" href="{{ route('Admin.EditProduct', $product->id) }}"><i
                                            class="fas fa-fw fa-pencil-alt"></i></a>

                                    {{-- <form style="display: inline" method="POST"
                                        action="{{ route('Admin.DeleteProduct', $product->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-fw fa-trash-alt"></i></button>
                                    </form> --}}
                                    <button type="button" class="btnDelete btn btn-danger" data-name="{{ $product->name }}"
                                        data-id="{{ $product->id }}" data-toggle="modal" data-target="#deleteModal"><i
                                            class="fas fa-fw fa-trash-alt"></i></button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Peringatan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                    <form id="modalDeleteForm" style="display: inline" method="POST" action="">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const form = $('#modalDeleteForm')
            const modalBody = $('#deleteModal > .modal-dialog > .modal-content > .modal-body')
            $('.btnDelete').on('click', function() {
                const productId = $(this).data('id')
                const productName = $(this).data('name')

                modalBody.html(`Apakah anda yakin ingin menghapus data <b>${productName}</b>?`)
                form.attr('action', `/admin-dashboard/product/${productId}`)
            })
        });
    </script>
@endsection
