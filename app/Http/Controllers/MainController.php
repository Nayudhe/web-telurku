<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\QueryException;
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

    public function all_products()
    {
        $products = Product::paginate(12);
        return view('pages.products')->with('products', $products);
    }

    public function detail_product(Product $product)
    {
        return view('pages.detail-product')->with('product', $product);
    }

    public function my_profile()
    {
        $user = Auth::user();
        return view('pages.my-profile')->with('user', $user);
    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        try {

            Message::create([
                'sender_name' => $request->name,
                'sender_email' => $request->email,
                'message' => $request->message,
            ]);

            return redirect()->back()->with('status', 'Pesan berhasil terkirim!');
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, gagal mengirim pesan');
        }
    }
}
