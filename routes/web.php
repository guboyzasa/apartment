<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

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

Auth::routes();

Route::middleware(['checkAgentMaintenance'])->group(function () {
        ## ADMIN
        Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
        Route::post('/register-store', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register-store');
        Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
        Route::get('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');

        Route::middleware(['auth','agent','preventBackHistory'])->group(function () {

                Route::get('/', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
                Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');
                Route::get('/search', [App\Http\Controllers\Agent\WorkController::class, 'search'])->name('search');
        });
  
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'preventBackHistory'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');

        Route::get('/add-customer', [App\Http\Controllers\Admin\CustomerAddController::class, 'index'])->name('customer.index');
        Route::get('/add-customer/listf1', [App\Http\Controllers\Admin\CustomerAddController::class, 'listF1'])->name('customer.listf1');
        Route::get('/add-customer/listf2', [App\Http\Controllers\Admin\CustomerAddController::class, 'listF2'])->name('customer.listf2');
        Route::get('/add-customer/listf3', [App\Http\Controllers\Admin\CustomerAddController::class, 'listF3'])->name('customer.listf3');
        Route::post('/add-customer/add', [App\Http\Controllers\Admin\CustomerAddController::class, 'store'])->name('customer.add');
        Route::post('/add-customer/set-active', [App\Http\Controllers\Admin\CustomerAddController::class, 'setActive'])->name('customer.set-active');
        Route::post('/add-customer/destroy', [App\Http\Controllers\Admin\CustomerAddController::class, 'destroy'])->name('customer.destroy');
        Route::post('/add-customer/update', [App\Http\Controllers\Admin\CustomerAddController::class, 'update'])->name('customer.update');

        Route::get('/add-vendor', [App\Http\Controllers\Admin\VendorAddController::class, 'index'])->name('vendor.index');
        Route::get('/add-vendor/list', [App\Http\Controllers\Admin\VendorAddController::class, 'list'])->name('vendor.list');
        Route::post('/add-vendor/add', [App\Http\Controllers\Admin\VendorAddController::class, 'store'])->name('vendor.add');
        Route::post('/add-vendor/set-active', [App\Http\Controllers\Admin\VendorAddController::class, 'setActive'])->name('vendor.set-active');
        Route::post('/add-vendor/destroy', [App\Http\Controllers\Admin\VendorAddController::class, 'destroy'])->name('vendor.destroy');
        Route::post('/add-vendor/update', [App\Http\Controllers\Admin\VendorAddController::class, 'update'])->name('vendor.update');

        Route::get('/store', [App\Http\Controllers\Admin\StoreController::class, 'index'])->name('store.index');
        Route::get('/store/listf1', [App\Http\Controllers\Admin\StoreController::class, 'listF1'])->name('store.listf1');
        Route::get('/store/listf2', [App\Http\Controllers\Admin\StoreController::class, 'listF2'])->name('store.listf2');
        Route::get('/store/listf3', [App\Http\Controllers\Admin\StoreController::class, 'listF3'])->name('store.listf3');
        Route::post('/store/add', [App\Http\Controllers\Admin\StoreController::class, 'store'])->name('store.add');
        Route::post('/store/update', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('store.update');
        Route::post('/store/destroy', [App\Http\Controllers\Admin\StoreController::class, 'destroy'])->name('store.destroy');
        Route::post('/store/set-active', [App\Http\Controllers\Admin\StoreController::class, 'setActive'])->name('store.set-active');

        Route::get('/store-vendor', [App\Http\Controllers\Admin\VendorStoreController::class, 'index'])->name('store-vendor.index');
        Route::get('/store-vendor/list', [App\Http\Controllers\Admin\VendorStoreController::class, 'list'])->name('store-vendor.list');
        Route::post('/store-vendor/add', [App\Http\Controllers\Admin\VendorStoreController::class, 'store'])->name('store-vendor.add');
        Route::post('/store-vendor/update', [App\Http\Controllers\Admin\VendorStoreController::class, 'update'])->name('store-vendor.update');
        Route::post('/store-vendor/destroy', [App\Http\Controllers\Admin\VendorStoreController::class, 'destroy'])->name('store-vendor.destroy');
        Route::post('/store-vendor/set-active', [App\Http\Controllers\Admin\VendorStoreController::class, 'setActive'])->name('store-vendor.set-active');

        Route::get('/balance', [App\Http\Controllers\Admin\BalanceController::class, 'index'])->name('balance.index');

});

Route::get('/pages-maintenance', [App\Http\Controllers\Controller::class, 'pagesmaintenance'])->name('maintenance');
Route::get('/404', [App\Http\Controllers\Controller::class, 'pageNotFond'])->name('404');

