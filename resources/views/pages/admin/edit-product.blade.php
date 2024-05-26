@extends('layouts.admin-dashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4 p-4">
        <form style="color: black" method="POST" action="{{ url('admin-dashboard/edit-product/' . $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nameInput">Nama Produk</label>
                <input style="color: black" type="text" id="nameInput" name="name" value="{{ $product->name }}"
                    class="form-control">
                @if ($errors->has('name'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="priceInput">Harga Produk (per krat)</label>
                <input style="color: black" type="number" id="priceInput" name="price" value="{{ $product->price }}"
                    class="form-control">
                @if ($errors->has('price'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="descriptionInput">Deskripsi Produk</label>
                <textarea style="color: black" id="descriptionInput" name="description" class="form-control">{{ $product->description }}"</textarea>
                @if ($errors->has('description'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="stockInput">Stok (krat)</label>
                <input style="color: black" type="number" id="stockInput" name="stock" value="{{ $product->stock }}"
                    class="form-control">
                @if ($errors->has('stock'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Foto</label>
                <input style="color: black" name="image" class="form-control" type="file" id="formFile">
                @if ($errors->has('image'))
                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>

            <button type="submit" class="d-flex btn btn-success mt-4 ml-auto">
                Update
            </button>
        </form>
    </div>
@endsection
