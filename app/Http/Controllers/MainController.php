<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::take(4)->get();

        return view('pages.home')->with('products', $products);
    }

    public function allProducts()
    {
        $products = Product::paginate(12);
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

    public function testquery()
    {
        $order_date = Order::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        dump($order_date->all());
        foreach ($order_date as $item) {
            dump($item->year . " " .  $item->month_name);
        }
    }
}
