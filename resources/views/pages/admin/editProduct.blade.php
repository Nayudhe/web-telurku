@extends('layouts.adminDashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4 p-4">
        <form method="POST" action="{{ url('admin-dashboard/edit-product/' . $product->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nameInput">Nama Produk</label>
                <input type="text" id="nameInput" name="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="priceInput">Harga Produk (per kg)</label>
                <input type="number" id="priceInput" name="price" value="{{ $product->price }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="descriptionInput">Deskripsi Produk</label>
                <textarea id="descriptionInput" name="description" class="form-control">{{ $product->description }}"</textarea>
            </div>

            <div class="form-group">
                <label for="stockInput">Stok (kg)</label>
                <input type="number" id="stockInput" name="stock" value="{{ $product->stock }}" class="form-control">
            </div>
            <button type="submit" class="d-flex btn btn-success mt-4 ml-auto">
                Update
            </button>
        </form>
    </div>
@endsection
