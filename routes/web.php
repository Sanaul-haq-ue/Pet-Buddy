<?php

use App\Http\Controllers\backEnd\AuthController;
use App\Http\Controllers\backEnd\ConpanyController;
use App\Http\Controllers\backEnd\DashboardController;
use App\Http\Controllers\backEnd\petController;
use App\Http\Controllers\backEnd\ServiceMController;
use App\Http\Controllers\backEnd\UserController;
use App\Http\Controllers\backEnd\ProductController;
use App\Http\Controllers\backEnd\ProductCategoryController;
use App\Http\Controllers\backEnd\ProductSubCategoryController;
use App\Http\Controllers\backEnd\ProductBrandController;
use App\Http\Controllers\backEnd\ProductUnitController;
use App\Http\Controllers\backEnd\PayController;
use App\Http\Controllers\backEnd\OrderStatusController;
use App\Http\Controllers\backEnd\SettingController;

use App\Http\Controllers\TrackOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
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
Route::get('/shop/{slug}', [ShopController::class, 'singlePage'])->name('shop.single-page');

Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [ShopController::class, 'clearCart'])->name('cart.clear');

Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');

Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/successfull/{order_no}', [OrderController::class, 'successfull'])->name('order.successfull');
Route::get('/order/invoice/{order_no}', [OrderController::class, 'downloadInvoice'])->name('order.invoice');
Route::get('/order/in/{order_no}', [OrderController::class, 'demo'])->name('order.in');

// Track Order Routes
Route::get('/track-order', [TrackOrderController::class, 'trackOrderForm'])->name('track.order.form');
Route::post('/track-order', [TrackOrderController::class, 'trackOrderSearch'])->name('track.order.search');
Route::get('/track-order/{order_no}', [TrackOrderController::class, 'trackOrderShow'])->name('track.order.show');


// Route::get('/clear-cart-session', function () {
//     session()->forget('cart');
//     return 'Cart session cleared!';
// });


Route::prefix('user')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/login', [UserAuthController::class, 'loginSubmit'])->name('user.login.submit');
        Route::post('/register', [UserAuthController::class, 'registerSubmit'])->name('user.register.submit');
    });

    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [UserDashbaord::class, 'dashboard'])->name('user.dashboard');
        Route::get('/get-breeds/{species_id}', [UserDashbaord::class, 'getBreeds'])->name('user.get-breeds');
        Route::post('/savePet', [UserDashbaord::class, 'savePet'])->name('pet.store');
        Route::put('/updatePets/{pet}', [UserDashbaord::class, 'updatePet'])->name('pet.update');
        Route::put('/pets/{pet}/soft-delete', [UserDashbaord::class, 'softDeletePet'])->name('pet.softDelete');
        Route::post('/profile/update', [UserDashbaord::class, 'updateProfile'])->name('profile.update');

        Route::get('/dashboard/track-order/{order_no}', [UserDashbaord::class, 'trackOrder'])->name('user.track-order');

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

        // Product Routes
        Route::get('/product', [ProductController::class, 'productIndex'])->name('product');
        Route::get('/product-Add', [ProductController::class, 'productAdd'])->name('productAdd');
        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product-Edit/{slug}', [ProductController::class, 'productEdit'])->name('productEdit');
        Route::post('/product-update/{slug}', [ProductController::class, 'productUpdate'])->name('product.update');
        Route::delete('/product-delete/{slug}', [ProductController::class, 'productDelete'])->name('product.delete');

        Route::get('/product-Category', [ProductCategoryController::class, 'productCategoryIndex'])->name('productCategory');
        Route::post('/product-Category/store', [ProductCategoryController::class, 'store'])->name('productCategory.store');
        Route::post('/product-Category/update', [ProductCategoryController::class, 'update'])->name('productCategory.update');
        Route::delete('/product-category/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('productCategory.delete');

        Route::get('/product-SubCategory', [ProductSubCategoryController::class, 'productSubCategoryIndex'])->name('productSubCategory');
        Route::post('/product-SubCategory/store', [ProductSubCategoryController::class, 'store'])->name('productSubCategory.store');
        Route::post('/product-SubCategory/update', [ProductSubCategoryController::class, 'update'])->name('productSubCategory.update');
        Route::delete('/product-SubCategory/delete/{id}', [ProductSubCategoryController::class, 'destroy'])->name('productSubCategory.delete');

        Route::get('/product-Brand', [ProductBrandController::class, 'productBrandIndex'])->name('productBrand');
        Route::post('/product-Brand/store', [ProductBrandController::class, 'store'])->name('productBrand.store');
        Route::post('/product-Brand/update', [ProductBrandController::class, 'update'])->name('productBrand.update');
        Route::delete('/product-brand/delete/{id}', [ProductBrandController::class, 'destroy'])->name('productBrand.delete');

        Route::get('/product-Unit', [ProductUnitController::class, 'productUnitIndex'])->name('productUnit');
        Route::post('/product-Unit/store', [ProductUnitController::class, 'store'])->name('productUnit.store');
        Route::post('/product-Unit/update', [ProductUnitController::class, 'update'])->name('productUnit.update');
        Route::delete('/product-unit/delete/{id}', [ProductUnitController::class, 'destroy'])->name('productUnit.delete');

        // Payment Routes
        Route::get('/pay-type', [PayController::class, 'pay_Type_Index'])->name('pay.type');
        Route::post('/payment-type/store', [PayController::class, 'storePaymentType'])->name('paymentType.store');
        Route::post('/payment-type/update', [PayController::class, 'updatePaymentType'])->name('paymentType.update');

        Route::get('/pay-method', [PayController::class, 'pay_Method_Index'])->name('pay.method');
        Route::post('/payment-method/store', [PayController::class, 'storePaymentMethod'])->name('paymentMethod.store');
        Route::post('/payment-method/update', [PayController::class, 'updatePaymentMethod'])->name('paymentMethod.update');

        Route::get('/pay-coupon', [PayController::class, 'pay_coupon_Index'])->name('pay.coupon');
        Route::post('/pay-coupon/store', [PayController::class, 'storePayCoupon'])->name('payCoupon.store');
        Route::post('/pay-coupon/update', [PayController::class, 'updatePayCoupon'])->name('payCoupon.update');

        Route::get('/shipping', [PayController::class, 'shipping_Index'])->name('shipping');
        // Route::post('/pay-coupon/update', [PayController::class, 'updatePayCoupon'])->name('payCoupon.update');

        Route::get('/order-status-control', [OrderStatusController::class, 'order_status_Index'])->name('order.status.control');
        // Route::get('/order-status-control/{order_no}', [OrderStatusController::class, 'manage'])->name('orders.manage');

        // Order status management
        Route::prefix('orders/{order}')->name('admin.orders.')->group(function () {
            Route::post('/confirm', [OrderStatusController::class, 'confirm'])->name('confirm');
            Route::post('/call-attempt', [OrderStatusController::class, 'callAttempt'])->name('call-attempt');
            Route::post('/status', [OrderStatusController::class, 'updateStatus'])->name('update-status');
            Route::post('/cancel', [OrderStatusController::class, 'cancel'])->name('cancel');
        });

        // Site Content
        Route::get('/site-content', [SettingController::class, 'siteContent'])->name('site.content');
        Route::put('/site-content/{section}', [SettingController::class, 'update'])
        ->whereIn('section', ['brand', 'hero', 'info', 'services', 'shop', 'contact', 'socials'])
        ->name('admin.site-content.update');
    });
});
