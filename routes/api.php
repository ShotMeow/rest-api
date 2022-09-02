<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserController::class, 'login']);
Route::post('/signup', [UserController::class, 'signup']);
Route::get('/products', [ProductController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::post('/cart/{product}', [CartController::class, 'store']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart/{product}', [CartController::class, 'delete']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::middleware('isAdmin')->group(function () {
        Route::post('/product', [ProductController::class, 'store']);
        Route::delete('/product/{product}', [ProductController::class, 'delete']);
        Route::patch('/product/{product}', [ProductController::class, 'update']);
    });
});
