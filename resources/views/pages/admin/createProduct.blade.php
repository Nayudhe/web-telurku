@extends('layouts.adminDashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4 p-4">
        <form method="POST" action="{{ url('admin-dashboard/add-product') }}">
            @csrf
            <div class="form-group">
                <label for="nameInput">Nama Produk</label>
                <input type="text" id="nameInput" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="priceInput">Harga Produk (per kg)</label>
                <input type="number" id="priceInput" name="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="descriptionInput">Deskripsi Produk</label>
                <textarea id="descriptionInput" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="stockInput">Stok (kg)</label>
                <input type="number" id="stockInput" name="stock" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">
                Submit
            </button>
        </form>
    </div>
@endsection
