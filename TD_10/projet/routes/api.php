<?php

use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index'])->name('api_product_index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('api_product_show');
Route::get('/sizes', [SizeController::class, 'index'])->name('api_size_index');
Route::get('/sizes/{size:code}', [SizeController::class, 'show'])->name('api_size_show');
Route::get('/categories', [CategoryController::class, 'index'])->name('api_category_index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('api_category_show');
Route::get('/api/orders', [])->name('api_order_index');
Route::get('/api/orders/{order}', [])->name('api_order_show');
