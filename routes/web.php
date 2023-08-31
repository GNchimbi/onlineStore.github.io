<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('Home.index');
Route::resource('products', ProductController::class)
->only(['index', 'show']);
Route::get('/product/{query?}', [ProductController::class, 'products'])->name('products');
Route::get('/about', [HomeController::class, 'about'])->name('Home.about');
Route::get('/contact', [ContactController::class, 'create'])->name('Home.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('admin')->group(function (){
    Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.home.index');
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/show/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{id}/destroy', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
});

Route::get('/cart', [CartController::class, 'index'])->name("cart.index");
Route::get('/cart/delete', [CartController::class, 'delete'])->name("cart.delete");
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name("cart.add");
Route::middleware('auth')->group(function (){
    Route::get('cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::get('my-account/orders', [MyAccountController::class, 'orders'])->name('myaccount.orders');
});

require __DIR__.'/auth.php';
