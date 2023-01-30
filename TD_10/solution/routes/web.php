<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSizeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Security\LoginController;
use App\Http\Controllers\Security\RegisterController;
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

Route::get('/debug', function () {
   $maintenace = new \App\Models\Maintenance();
   $maintenace->message = 'Maintenance';
   $maintenace->start_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2023-01-30 12:00');
   $maintenace->end_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2023-01-31 19:00');

   $maintenace->save();

   echo 'Maintenance planifiée';
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login_authenticate');
Route::delete('/logout', [LoginController::class, 'logout'])->name('login_logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register_store');

Route::get('/', [HomepageController::class, 'index'])->middleware(['next.maintenance'])->name('homepage');

Route::get('/categories', [CategoryController::class, 'index'])->name('category_index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category_show');

Route::get('/produit/{product:slug}', [ProductController::class, 'show'])->name('product_show');

Route::post('/produit/{product:slug}/commander', [OrderController::class, 'create'])->name('order_create');
Route::get('/order/{order:id}/status/{orderState:code}', [OrderStateController::class, 'update'])->name('order_state_update');

Route::prefix('admin')
    ->middleware(['auth', 'can:show-admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/taille/{size:code}/editer', [AdminSizeController::class, 'edit'])->name('admin_size_edit');
        Route::put('/taille/{size:code}', [AdminSizeController::class, 'update'])->name('admin_size_update');
    });
