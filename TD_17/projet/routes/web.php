<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSizeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Security\LoginController;
use App\Http\Controllers\Security\RegisterController;
use App\Http\Controllers\Security\ResetPasswordController;
use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login_authenticate');
Route::delete('/logout', [LoginController::class, 'logout'])->name('login_logout');

Route::get('/forgot-password', [ResetPasswordController::class, 'forgot'])->middleware('guest')->name('forgot_password');

Route::post('/forgot-password', [ResetPasswordController::class, 'forgotEmail'])->middleware('guest')->name('forgot_password_email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register_store');

Route::get('/email/verify', function () {
    return view('security.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('homepage');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [HomepageController::class, 'index'])->middleware(['next.maintenance'])->name('homepage');

Route::get('/categories', [CategoryController::class, 'index'])->name('category_index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category_show');

Route::get('/produit/{product:slug}', [ProductController::class, 'show'])->name('product_show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/produit/{product:slug}/commander', [OrderController::class, 'create'])->name('order_create');
});

Route::prefix('admin')
    ->middleware(['auth', 'can:show-admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/taille/{size:code}/editer', [AdminSizeController::class, 'edit'])->name('admin_size_edit');
        Route::put('/taille/{size:code}', [AdminSizeController::class, 'update'])->name('admin_size_update');
        Route::get('/order/{order:id}/status/{orderState:code}', [OrderStateController::class, 'update'])->name('order_state_update');
    });

Route::get('/todos', [TodoController::class, 'index'])->name('todos');
