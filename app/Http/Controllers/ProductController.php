<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('pages.admin.productList')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.admin.showProduct')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.admin.editProduct')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image != "default.png") {
                $image_path = public_path('product_images/' . $product->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $product->delete();
            return redirect()->back()->with('status', 'Data berhasil terhapus');
        } catch (QueryException $exception) {
            return redirect()->route('Admin.Products')->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }
}
