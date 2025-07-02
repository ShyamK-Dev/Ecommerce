<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrdersManager;
use App\Http\Controllers\ProductsManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', [ProductsManager::class, 'index'])
    ->name('home');


Route::get('login', [AuthManager::class, 'login'])
    ->name('login');

Route::get('logout', [AuthManager::class, 'logout'])
    ->name('logout');

Route::post('login', [AuthManager::class, 'loginPost'])
    ->name('login.post');

Route::get('register', [AuthManager::class, 'register'])
    ->name('register');

Route::post('register', [AuthManager::class, 'registerPost'])
    ->name('register.post');

Route::get('/product/{slug}', [ProductsManager::class, 'details'])
    ->name('product.details');

Route::middleware('auth')->group(function(){

Route::get('/cart/{id}', [ProductsManager::class, 'addToCart'])
    ->name('cart.add');

Route::get('/cart', [ProductsManager::class, 'showCart'])
    ->name('cart.show');

Route::patch('/cart/{product_id}', [ProductsManager::class, 'updateCart'])
    ->name('cart.update');

Route::delete('/cart/{product_id}', [ProductsManager::class, 'removeFromCart'])
    ->name('cart.remove');

Route::get('/checkout', [OrdersManager::class, 'showCheckout'])
    ->name('checkout.show');

Route::post('/checkout', [OrdersManager::class, 'checkoutPost'])
    ->name('checkout.post');
});

// routes/web.php
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])
    ->name('payment.show');
    
Route::post('/create-order', [PaymentController::class, 'createOrder'])
    ->name('payment.create-order');
Route::get('/verify-payment', [PaymentController::class, 'verify'])
    ->name('payment.verify');


   