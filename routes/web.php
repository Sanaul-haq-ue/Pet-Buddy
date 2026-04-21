<?php

use App\Http\Controllers\backEnd\AuthController;
use App\Http\Controllers\backEnd\ConpanyController;
use App\Http\Controllers\backEnd\DashboardController;
use App\Http\Controllers\backEnd\petController;
use App\Http\Controllers\backEnd\ServiceMController;
use App\Http\Controllers\backEnd\UserController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserDashbaord;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::prefix('user')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/login', [UserAuthController::class, 'loginSubmit'])->name('user.login.submit');
        Route::post('/register', [UserAuthController::class, 'registerSubmit'])->name('user.register.submit');
    });

    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [UserDashbaord::class, 'dashboard'])->name('user.dashboard');
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
        Route::post('/booking/store', [UserAppointmentController::class, 'store'])->name('user.booking.store');
    });
});


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
        Route::delete('/deleteCustomer/{id}', [UserController::class, 'deleteCustomer'])->name('customer.delete');
        Route::get('/get-breeds/{species_id}', [UserController::class, 'getBreeds']);

        Route::get('/petManagement', [petController::class, 'petManagement'])->name('petManagement');
        Route::post('/saveSpecies', [petController::class, 'saveSpecies'])->name('petManagement.saveSpecies');
        Route::put('/species/{id}', [petController::class, 'update'])->name('species.update');
        Route::delete('/species/{id}', [petController::class, 'destroy'])->name('species.destroy');

        Route::post('/saveBreed', [petController::class, 'saveBreed'])->name('petManagement.saveBreed');
        Route::patch('/updateBreed/{id}', [petController::class, 'updateBreed'])->name('petManagement.updateBreed');
        Route::delete('/deleteBreed/{id}', [petController::class, 'deleteBreed'])->name('petManagement.deleteBreed');

        Route::get('/company', [ConpanyController::class, 'company'])->name('company');
        Route::post('/saveCompany', [ConpanyController::class, 'saveCompany'])->name('saveCompany');
        Route::post('/updateCompany', [ConpanyController::class, 'updateCompany'])->name('updateCompany');
        Route::delete('/deleteCompany/{id}', [ConpanyController::class, 'deleteCompany'])->name('deleteCompany');

        Route::get('/serviceManagement', [ServiceMController::class, 'serviceManagement'])->name('serviceManagement');
        Route::get('/addService', [ServiceMController::class, 'addService'])->name('addService');
        Route::get('/edit/Service/{id}', [ServiceMController::class, 'editService'])->name('editService');
        Route::post('/save/service', [ServiceMController::class, 'saveService'])->name('saveService');
        Route::post('/update/service/{id}', [ServiceMController::class, 'updateService'])->name('updateService');

        Route::get('/get-upazilas/{id}', [ServiceMController::class, 'getUpazilas'])->name('upazilasByDistrict');
        Route::get('/get-unions/{id}', [ServiceMController::class, 'getUnions'])->name('unionsByUpazila');

        Route::get('/get-breeds/{id}', [ServiceMController::class, 'getBreeds'])->name('getBreeds');
        Route::get('/get-sizes/{id}', [ServiceMController::class, 'getSizes'])->name('getSizes');

        Route::post('/saveCategory', [ServiceMController::class, 'saveCategory'])->name('saveCategory');
        Route::post('/updateCategory', [ServiceMController::class, 'updateCategory'])->name('updateCategory');
        Route::get('/addService/store', [ServiceMController::class, 'addService'])->name('admin.services.store');
    });
});
