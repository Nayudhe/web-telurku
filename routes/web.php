<?php

use App\Http\Controllers\AdminDashboardController;
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

Route::get('/', function () {
    return view('welcome');
});


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
