<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('pages.admin.product-list')->with('products', $products);
    }

    public function create()
    {
        return view('pages.admin.create-product');
    }

    public function store(StoreProductRequest $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'stock' => ['required'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        try {
            $imageName =  strtolower(str_replace(' ', '-', $request->name)) . '_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('product_images'), $imageName);

            $product = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->image = $imageName;
            $product->save();
            return redirect()->route('Admin.CreateProduct')->with('status', 'Produk berhasil ditambahkan');
        } catch (QueryException $exception) {
            return redirect()->route('Admin.CreateProduct')->with('status', 'Gagal menambahkan produk: ' . $exception);
        }
    }

    public function show(Product $product)
    {
        return view('pages.admin.show-product')->with('product', $product);
    }


    public function edit(Product $product)
    {
        return view('pages.admin.edit-product')->with('product', $product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'stock' => ['required'],
        ]);

        try {
            if ($request->hasFile('image')) {
                $imageName =  strtolower(str_replace(' ', '-', $request->name)) . '_' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('product_images'), $imageName);
                $product->image = $imageName;
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->update();

            return redirect()->route('Admin.EditProduct', $product->id)->with('status', 'Data produk berhasil diperbarui');
        } catch (QueryException $exception) {
            return redirect()->route('Admin.EditProduct', $product->id)->with('status', 'Gagal memperbarui data: ' . $exception);
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image != "default.png") {
                $image_path = public_path('product_images/' . $product->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $order_items = OrderItem::where('product_id', $product->id)->pluck('order_id')->toArray();
            Order::whereIn('id', $order_items)->where('status', '!=', 'done')->update(['status' => 'canceled']);

            $product->delete();
            return redirect()->back()->with('status', 'Data berhasil terhapus');
        } catch (QueryException $exception) {
            return redirect()->route('Admin.Products')->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }

    public function testing()
    {
        $cart_items = CartItem::get();
        $product_ids = $cart_items->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $product_ids)->get();

        foreach ($products as $item) {
            $qty = $cart_items->where('product_id', $item->id)->first()->quantity;
            dump("stok => ", $item->stock);
            dump("produk id => ", $item->id);
            dump("QTY => ", $qty);
            dump("=========================================================");
            if ($item->stock < $qty) {
                dump("gacukup");
            } else {
                dd("nais");
            }
        }
    }
}
