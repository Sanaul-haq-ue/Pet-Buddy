<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\backEnd\AdminController;
use App\Http\Controllers\backEnd\AuthController;
use App\Http\Controllers\backEnd\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/homemobile', [HomeController::class, 'homemobile'])->name('homemobile');

Route::prefix('admin')->group(function () {

    // Guest (admin not logged in)
    Route::middleware('guest')->group(function () {
        Route::get('/authentication', [AuthController::class, 'login'])->name('admin.login');
        Route::post('/authenticatiooon', [AuthController::class, 'loginSubmit'])->name('login.submit');
    });

    // Admin (logged in)
    Route::middleware('admin')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/appointment', [AdminController::class, 'appointment'])->name('appointment');
        Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
        Route::get('/customer', [UserController::class, 'customer'])->name('customer');
    });

});
