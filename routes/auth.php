<?php

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can add authentication routes in project every route to
| for authenticate or check roles or guards must be set here
|
*/


Route::post('/login', [UserController::class, 'login'])->name("login");
Route::post('/register', [UserController::class, 'register'])->name("register");
