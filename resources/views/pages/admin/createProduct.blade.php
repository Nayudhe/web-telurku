@extends('layouts.adminDashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4 p-4">
        <form method="POST" action="{{ url('admin-dashboard/add-product') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nameInput">Nama Produk</label>
                <input type="text" id="nameInput" name="name" class="form-control" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="priceInput">Harga Produk (per kg)</label>
                <input type="number" id="priceInput" name="price" class="form-control" value="{{ old('price') }}">
                @if ($errors->has('price'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="descriptionInput">Deskripsi Produk</label>
                <textarea id="descriptionInput" name="description" class="form-control">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="stockInput">Stok (kg)</label>
                <input type="number" id="stockInput" name="stock" class="form-control" value="{{ old('stock') }}"
                    value="{{ old('email') }}">
                @if ($errors->has('stock'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Foto</label>
                <input name="image" class="form-control" type="file" id="formFile">
                @if ($errors->has('image'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
