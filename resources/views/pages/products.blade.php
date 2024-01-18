@extends('layouts.mainLayout')

@section('body')
    <div>
        <h1>Our Products</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, ratione.</p>
        @foreach ($products as $product)
            {{ $product->name }}
        @endforeach
        {{ $products->links() }}
    </div>
@endsection
