<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
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
Route::get('/orders', function () {
    return view('pages.myOrder');
})->name('Orders');
Route::get('/my-profile', function () {
    return view('pages.myProfile');
})->name('Profile');
Route::get('/cart', function () {
    return view('pages.cart');
})->name('Cart');


Route::get('/about', function () {
    return view('pages.about');
})->name('About');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('Contact');


// ADMIN DASHBOARD
Route::prefix('/admin-dashboard')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('Admin.Dashboard');

    Route::get('/products',  [ProductController::class, 'index'])->name('Admin.Products');
    Route::get('/add-product',  [ProductController::class, 'create'])->name('Admin.CreateProduct');
    Route::post('/add-product',  [ProductController::class, 'store'])->name('Admin.StoreProduct');
    Route::get('/edit-product/{product}',  [ProductController::class, 'edit'])->name('Admin.EditProduct');
    Route::put('/edit-product/{product}',  [ProductController::class, 'update'])->name('Admin.UpdateProduct');
    Route::get('/product/{product}',  [ProductController::class, 'show'])->name('Admin.ShowProduct');
    Route::delete('/product/{product}',  [ProductController::class, 'destroy'])->name('Admin.DeleteProduct');

    Route::get('/users',  [AdminDashboardController::class, 'userList'])->name('Admin.Users');
    Route::delete('/user/{user}',  [AdminDashboardController::class, 'deleteUser'])->name('Admin.DeleteUser');
});

Route::get('/admin-login', function () {
    return view('pages.admin.login');
})->name('Admin.Login');
