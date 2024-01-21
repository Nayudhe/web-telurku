<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH
Route::get('/login', [AuthController::class, 'loginView'])->name('Auth.LoginView')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('Auth.Login')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('Auth.RegisterView')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('Auth.Register')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('Auth.Logout')->middleware('auth');


Route::get('/', [MainController::class, 'index'])->name('Home');
Route::get('/products', [MainController::class, 'allProducts'])->name('Product.All');
Route::get('/product/{product}', [MainController::class, 'detailProduct'])->name('Product.Detail');
Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('Checkout');
Route::get('/my-orders', [OrderController::class, 'myOrder'])->name('Orders');
Route::get('/my-profile',  [MainController::class, 'myProfile'])->name('Profile');


Route::get('/cart', [CartItemController::class, 'index'])->name('Cart.View')->middleware('auth');
Route::post('/cart', [CartItemController::class, 'store'])->name('Cart.Add')->middleware('auth');
Route::delete('/cart/{cartItem}',  [CartItemController::class, 'destroy'])->name('Cart.Delete')->middleware('auth');
Route::post('/cart/checkout', [CartItemController::class, 'checkout'])->name('Cart.Checkout')->middleware('auth');

Route::get('/checkout', [OrderController::class, 'create'])->name('Checkout.View')->middleware('auth');
Route::post('/checkout/order', [OrderController::class, 'store'])->name('Checkout.Order')->middleware('auth');


Route::get('/about', function () {
    return view('pages.about');
})->name('About');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('Contact');


// ADMIN DASHBOARD
Route::group(['prefix' => 'admin-dashboard', 'middleware' => 'isAdmin'], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('Admin.Dashboard');

    Route::get('/products',  [ProductController::class, 'index'])->name('Admin.Products');
    Route::get('/add-product',  [ProductController::class, 'create'])->name('Admin.CreateProduct');
    Route::post('/add-product',  [ProductController::class, 'store'])->name('Admin.StoreProduct');
    Route::get('/edit-product/{product}',  [ProductController::class, 'edit'])->name('Admin.EditProduct');
    Route::put('/edit-product/{product}',  [ProductController::class, 'update'])->name('Admin.UpdateProduct');
    Route::get('/product/{product}',  [ProductController::class, 'show'])->name('Admin.ShowProduct');
    Route::delete('/product/{product}',  [ProductController::class, 'destroy'])->name('Admin.DeleteProduct');

    Route::get('/orders',  [OrderController::class, 'index'])->name('Admin.Orders');
    Route::get('/orders/{status}',  [OrderController::class, 'byStatus'])->name('Admin.OrdersByStatus');
    Route::post('/order/update/{order}/{status}',  [OrderController::class, 'changeOrderStatus'])->name('Admin.StatusOrder');

    Route::get('/users',  [AdminDashboardController::class, 'userList'])->name('Admin.Users');
    Route::delete('/user/{user}',  [AdminDashboardController::class, 'deleteUser'])->name('Admin.DeleteUser');
});

Route::get('/admin-login', function () {
    return view('pages.admin.adminLogin');
})->name('Admin.Login')->middleware('guest');
Route::post('/admin-login', [AuthController::class, 'authenticate'])->name('Auth.Login')->middleware('guest');
