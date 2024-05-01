<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Midtrans\CreateSnapTokenService;

class OrderController extends Controller
{
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
        if ($order->status != 'accepted' || $order->status != 'done') {
            $order->status = $status;
            $order->update();
        }
        return redirect()->back();
    }

    public function changePaymentStatus(Order $order, $order_status, $payment_status)
    {
        $order->status = $order_status;
        $order->payment_status = $payment_status;
        $order->update();
        return redirect()->route('Orders');
    }

    public function acceptOrder(Order $order)
    {
        $item_details = collect([]);
        foreach ($order->order_items as $key => $item) {
            $arr = collect([]);
            $arr->put('id', $item->product->id);
            $arr->put('price', $item->product->price);
            $arr->put('quantity', $item->quantity);
            $arr->put('name', $item->product->name);
            $item_details->push($arr);
        }

        $shipping_cost = collect([]);
        $shipping_cost->put('id', 'Ongkir');
        $shipping_cost->put('name', 'Biaya Pengiriman');
        $shipping_cost->put('quantity', 1);

        if ($item_details->sum('quantity') >= 20) {
            $shipping_cost->put('price', 5000);
        } else {
            $shipping_cost->put('price', 20000);
        }

        $item_details->push($shipping_cost);

        $params = [
            'transaction_details' => [
                'order_id' => "TL" . $order->id . "-" . now()->timestamp,
                'gross_amount' => $order->total_price,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                "shipping_address" => [
                    "first_name" => $order->user->name,
                    "address" => $order->address,
                ]
            ]
        ];

        $midtrans = new CreateSnapTokenService($params);
        $snapToken = $midtrans->getSnapToken();

        $order->snap_token = $snapToken;
        $order->status = 'accepted';
        $order->update();

        return redirect()->back();
    }

    public function create(Request $request)
    {
        if ($request->session()->exists('cart_items')) {
            $cart_items = CartItem::whereIn('id', $request->session()->get('cart_items'))->get();

            return view('pages.checkout')->with('cart_items', $cart_items);
        } else {
            return redirect()->back();
        }
    }

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
        if ($cart_items->sum("quantity") >= 20) {
            $shipping_cost = 5000;
        }

        $full_address = $request->address . ", " . $request->city . ", " . $request->province . " " . $request->postal_code;
        $total_price = $cart_items->sum('total_price') + $shipping_cost;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total_price,
            'address' => $full_address,
            'status' => "waiting",
            'payment_status' => 1
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

    public function payment(Order $order)
    {
        if ($order->payment_status != 1) {
            return redirect()->route('Orders');
        }
        $total_price = 0;
        foreach ($order->order_items as $key => $item) {
            $sub = $item->quantity * $item->product->price;
            $total_price += $sub;
        }
        return view('pages.payment')
            ->with('order', $order)
            ->with('total_price', $total_price);
    }


    public function myOrder()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('pages.myOrder')->with('orders', $orders);
    }

    public function printReport(Request $request)
    {
        $this->validate($request, [
            'monthyear' => 'required'
        ]);

        $month = explode(',', $request->monthyear)[0];
        $year = explode(',', $request->monthyear)[1];

        $date = Carbon::createFromFormat('mY', sprintf("%02d", $month) . $year)->translatedFormat('F Y');
        return Excel::download(new OrdersExport($year, $month), 'Laporan Pendapatan Andri Jaya Telor ' . $date . '.xlsx');

        // $pdf = PDF::loadView('pages.admin.generateReport', ['orders' => $orders, 'date' => $date]);
        // return $pdf->stream('Laporan-Pendapatan-Telurku.pdf');
    }
}
