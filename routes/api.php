<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [UserController::class, 'login'])->name("login");

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/order/create', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/payment/purchase/{order}', [PaymentController::class, 'purchase'])->name('payment.purchase');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
