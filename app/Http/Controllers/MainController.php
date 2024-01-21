<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.detailProduct')->with('product', $product);
    }

    public function myProfile()
    {
        $user = Auth::user();
        return view('pages.myProfile')->with('user', $user);
    }
}
