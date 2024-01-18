<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::take(4)->get();

        return view('pages.home')->with('products', $products);
    }

    public function allProducts()
    {
        $products = Product::paginate(4);
        return view('pages.products')->with('products', $products);
    }

    public function detailProduct(Product $product)
    {
    }
}
