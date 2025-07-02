<?php

use App\Http\Controllers\OrdersManager;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('/razorpay/webhook', [PaymentController::class, 'razorpayWebhook']);
