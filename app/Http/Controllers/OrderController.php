<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('pages.admin.orderList')->with('orders', $orders);
    }

    public function byStatus($status)
    {
        if ($status != 'waiting' && $status != 'accepted' && $status != 'done' && $status != 'canceled') {
            return redirect()->back();
        }
        $orders = Order::where('status', $status)->paginate(10);
        return view('pages.admin.orderListByStatus')
            ->with('orders', $orders)
            ->with('status', $status);
    }

    public function changeOrderStatus(Order $order, $status)
    {
        $order->status = $status;
        $order->update();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->session()->exists('cart_items')) {
            $cart_items = CartItem::whereIn('id', $request->session()->get('cart_items'))->get();

            return view('pages.checkout')->with('cart_items', $cart_items);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $this->validate($request, [
            'province' => ['required'],
            'city' => ['required'],
            'postal_code' => ['required'],
            'address' => ['required'],
        ]);

        $cart_items = [];
        if ($request->session()->exists('cart_items')) {
            $cart_items = CartItem::whereIn('id', $request->session()->get('cart_items'))->get();
        } else {
            return redirect()->route('Cart.View')->with('error', 'Terjadi kesalahan saat checkout silakan ulangi kembali.');
        }

        $shipping_cost = 20000;
        $full_address = $request->address . ", " . $request->city . ", " . $request->province . " " . $request->postal_code;
        $total_price = $cart_items->sum('total_price') + $shipping_cost;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total_price,
            'address' => $full_address,
            'status' => "waiting",
        ]);

        foreach ($cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
            ]);

            CartItem::destroy($item->id);

            $product = Product::find($item->product->id);
            $product->stock = $product->stock - $item->quantity;
            $product->update();
        }

        $request->session()->remove('cart_items');
        return redirect()->route('Orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function myOrder()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('pages.myOrder')->with('orders', $orders);
    }
}
