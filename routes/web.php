<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\backEnd\DashboardController;
use App\Http\Controllers\backEnd\AuthController;
use App\Http\Controllers\backEnd\ConpanyController;
use App\Http\Controllers\backEnd\ServiceMController;
use App\Http\Controllers\backEnd\petController;
use App\Http\Controllers\backEnd\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::prefix('admin')->group(function () {

    // Guest (admin not logged in)
    Route::middleware('guest')->group(function () {
        Route::get('/authentication', [AuthController::class, 'login'])->name('admin.login');
        Route::post('/authenticatiooon', [AuthController::class, 'loginSubmit'])->name('login.submit');
    });

    // Admin (logged in)
    Route::middleware('admin')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/appointment', [DashboardController::class, 'appointment'])->name('appointment');
        Route::get('/inventory', [DashboardController::class, 'inventory'])->name('inventory');


        Route::get('/customer', [UserController::class, 'customer'])->name('customer');
        Route::post('/saveCustomer', [UserController::class, 'saveCustomer'])->name('customer.store');
        Route::post('/updateCustomer', [UserController::class, 'updateCustomer'])->name('customer.update');

        Route::get('/petManagement', [petController::class, 'petManagement'])->name('petManagement');
        Route::post('/saveSpecies', [petController::class, 'saveSpecies'])->name('petManagement.saveSpecies');
        Route::post('/saveBreed', [petController::class, 'saveBreed'])->name('petManagement.saveBreed');
        Route::patch('/updateBreed/{id}', [petController::class, 'updateBreed'])->name('petManagement.updateBreed');
        Route::patch('/toggleBreedStatus/{id}', [petController::class, 'toggleBreedStatus'])->name('petManagement.toggleBreedStatus');


        Route::get('/company', [ConpanyController::class, 'company'])->name('company');

        Route::get('/serviceManagement', [ServiceMController::class, 'serviceManagement'])->name('serviceManagement');
        Route::get('/addService', [ServiceMController::class, 'addService'])->name('addService');
        Route::post('/saveService', [ServiceMController::class, 'saveService'])->name('saveService');
        Route::get('/upazilas-by-district/{district_id}', [ServiceMController::class, 'upazilasByDistrict'])->name('upazilasByDistrict');
        Route::get('/unions-by-upazila/{upazila_id}', [ServiceMController::class, 'unionsByUpazila'])->name('unionsByUpazila');
        
        Route::post('/saveCategory', [ServiceMController::class, 'saveCategory'])->name('saveCategory');
        Route::post('/updateCategory', [ServiceMController::class, 'updateCategory'])->name('updateCategory');
        
    });
});
