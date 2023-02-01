<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SizeController;
use Illuminate\Http\Request;
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

Route::post('/login', [AuthController::class, 'login'])->name('api_login');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index'])->name('api_product_index');
Route::post('/products', [ProductController::class, 'create'])->name('api_product_create');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('api_product_show');
Route::patch('/products/{product:slug}', [ProductController::class, 'update'])->name('api_product_update');
Route::get('/sizes', [SizeController::class, 'index'])->name('api_size_index');
Route::get('/sizes/{size:code}', [SizeController::class, 'show'])->name('api_size_show');
Route::get('/categories', [CategoryController::class, 'index'])->name('api_category_index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('api_category_show');

Route::middleware(['auth:sanctum', 'can:show-admin'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('api_order_index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('api_order_show');
});
