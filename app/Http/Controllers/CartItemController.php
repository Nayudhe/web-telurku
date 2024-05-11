<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart_items = CartItem::where('user_id', $user->id)->get();
        return view('pages.cart')->with('cart_items', $cart_items);
    }

    public function store(StoreCartItemRequest $request)
    {
        $this->validate($request, [
            'product_id' => ['required']
        ]);
        $product = Product::find($request->product_id);
        $this->validate($request, [
            'quantity' => ['required', 'numeric', 'min:1', 'max:' . $product->stock],
        ]);
        $user = Auth::user();
        $total_price =  $product->price * $request->quantity;

        $cart = CartItem::firstOrNew(
            ['user_id' => $user->id, 'product_id' =>  $product->id]
        );
        $cart->quantity = $cart->quantity + $request->quantity;
        $cart->total_price = $cart->total_price + $total_price;

        if ($cart->save()) {
            return redirect()->back()->with('success', 'Berhasil ditambahkan ke keranjang!');
        }
    }

    public function checkout(Request $request)
    {
        $this->validate($request, [
            'cart_item_id' => 'required'
        ]);

        $cart_items = CartItem::whereIn('id', $request->cart_item_id)->get();
        $product_ids = $cart_items->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $product_ids)->get();

        foreach ($products as $item) {
            $qty = $cart_items->where('product_id', $item->id)->first()->quantity;
            if ($item->stock < $qty) {
                return redirect()->back()->with('stock-error', 'Stok produk tidak mencukupi!');
            }
        }
        $request->session()->put('cart_items', $request->cart_item_id);
        return redirect()->route('Checkout.View');
    }

    public function destroy(CartItem $cartItem)
    {
        try {
            $cartItem->delete();
            return redirect()->route('Cart.View');
        } catch (QueryException $exception) {
            return redirect()->route('Cart.View')->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }
}
