<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])
    ->name("login");

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])
    ->name('product.index');

Route::group(['middleware' => 'auth'], function () {
    // Todo: add other every other routs to this group ;)
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
