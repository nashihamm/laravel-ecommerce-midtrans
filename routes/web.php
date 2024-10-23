<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;



Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');



Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/', function () {
        return view('seller.index');
    })->name('index');


    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/', [CustomerController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile.index');

    Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile.index');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{order_id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');




    //proses PESANAN
    Route::get('/orders', action: [OrderController::class, 'customerIndex'])->name('order.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');

        //checkout
    Route::get('/checkout/{order_id}', [CheckoutController::class, 'checkout'])->name('checkout.index');


    //paymeeeeeennntttt
    Route::get('/payment/process/{order_id}', [PaymentController::class, 'process'])->name('payment.process');
    
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');


});

require __DIR__.'/auth.php';
