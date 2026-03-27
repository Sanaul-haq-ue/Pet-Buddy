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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::middleware(['admin'])->prefix('admin')->group(function()
{
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/appointment', [AdminController::class, 'appointment'])->name('appointment');
    Route::get('/customer', [AdminController::class, 'customer'])->name('customer');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
});


Route::get('/authentication', [AuthController::class, 'login'])->name('login');