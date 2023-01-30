<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSizeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [SecurityController::class, 'login'])->name('login');
Route::post('/login', [SecurityController::class, 'authenticate'])->name('login_authenticate');
Route::delete('/logout', [SecurityController::class, 'logout'])->name('login_logout');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/categories', [CategoryController::class, 'index'])->name('category_index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category_show');

Route::get('/produit/{product:slug}', [ProductController::class, 'show'])->name('product_show');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/taille/{size:code}/editer', [AdminSizeController::class, 'edit'])->name('admin_size_edit');
        Route::put('/taille/{size:code}', [AdminSizeController::class, 'update'])->name('admin_size_update');
    });
