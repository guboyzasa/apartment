<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['checkAgentMaintenance'])->group(function () {
    ## ADMIN
    // Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    // Route::post('/register-store', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register-store');
    // Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
    // Route::get('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');

    Route::middleware(['auth', 'agent', 'preventBackHistory'])->group(function () {
        Route::get('/', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');
        // Route::get('/search', [App\Http\Controllers\Agent\WorkController::class, 'search'])->name('search');
    });

});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'preventBackHistory'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');

    Route::get('/room', [App\Http\Controllers\Admin\AddRoomController::class, 'index'])->name('room.index');
    Route::get('/room/listf1', [App\Http\Controllers\Admin\AddRoomController::class, 'listF1'])->name('room.listf1');
    Route::get('/room/listf2', [App\Http\Controllers\Admin\AddRoomController::class, 'listF2'])->name('room.listf2');
    Route::get('/room/listf3', [App\Http\Controllers\Admin\AddRoomController::class, 'listF3'])->name('room.listf3');
    Route::post('/room/add', [App\Http\Controllers\Admin\AddRoomController::class, 'store'])->name('room.add');
    Route::post('/get-floors', [App\Http\Controllers\Admin\AddRoomController::class, 'getFloorsByCompany'])->name('get.floors');
    Route::post('/room/set-active', [App\Http\Controllers\Admin\AddRoomController::class, 'setActive'])->name('room.set-active');
    Route::post('/room/destroy', [App\Http\Controllers\Admin\AddRoomController::class, 'destroy'])->name('room.destroy');
    Route::post('/room/update', [App\Http\Controllers\Admin\AddRoomController::class, 'update'])->name('room.update');

    Route::get('/room-rates', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'index'])->name('room-rates.index');
    Route::get('/room-rates/list', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'list'])->name('room-rates.list');
    Route::post('/room-rates/add', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'store'])->name('room-rates.add');
    Route::post('/room-rates/set-active', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'setActive'])->name('room-rates.set-active');
    Route::post('/room-rates/destroy', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'destroy'])->name('room-rates.destroy');
    Route::post('/room-rates/update', [App\Http\Controllers\Admin\AddRoomRatesController::class, 'update'])->name('room-rates.update');

    Route::get('/room-floor', [App\Http\Controllers\Admin\AddFloorController::class, 'index'])->name('room-floor.index');
    Route::get('/room-floor/list', [App\Http\Controllers\Admin\AddFloorController::class, 'list'])->name('room-floor.list');
    Route::post('/room-floor/add', [App\Http\Controllers\Admin\AddFloorController::class, 'store'])->name('room-floor.add');
    Route::post('/room-floor/set-active', [App\Http\Controllers\Admin\AddFloorController::class, 'setActive'])->name('room-floor.set-active');
    Route::post('/room-floor/destroy', [App\Http\Controllers\Admin\AddFloorController::class, 'destroy'])->name('room-floor.destroy');
    Route::post('/room-floor/update', [App\Http\Controllers\Admin\AddFloorController::class, 'update'])->name('room-floor.update');

    Route::get('/list-payment', [App\Http\Controllers\Admin\ListPaymentController::class, 'index'])->name('list-payment.index');
    Route::get('/list-payment/list', [App\Http\Controllers\Admin\ListPaymentController::class, 'list'])->name('list-payment.list');
    Route::post('/list-payment/add', [App\Http\Controllers\Admin\ListPaymentController::class, 'store'])->name('list-payment.add');
    Route::post('/list-payment/set-active', [App\Http\Controllers\Admin\ListPaymentController::class, 'setActive'])->name('list-payment.set-active');
    Route::post('/list-payment/destroy', [App\Http\Controllers\Admin\ListPaymentController::class, 'destroy'])->name('list-payment.destroy');
    Route::post('/list-payment/update', [App\Http\Controllers\Admin\ListPaymentController::class, 'update'])->name('list-payment.update');

    Route::get('/condition', [App\Http\Controllers\Admin\ConditionController::class, 'index'])->name('condition.index');
    Route::get('/condition/list', [App\Http\Controllers\Admin\ConditionController::class, 'list'])->name('condition.list');
    Route::post('/condition/add', [App\Http\Controllers\Admin\ConditionController::class, 'store'])->name('condition.add');
    Route::post('/condition/set-active', [App\Http\Controllers\Admin\ConditionController::class, 'setActive'])->name('condition.set-active');
    Route::post('/condition/destroy', [App\Http\Controllers\Admin\ConditionController::class, 'destroy'])->name('condition.destroy');
    Route::post('/condition/update', [App\Http\Controllers\Admin\ConditionController::class, 'update'])->name('condition.update');

    Route::get('/con-customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('con-customer.index');
    Route::get('/con-customer/list', [App\Http\Controllers\Admin\CustomerController::class, 'list'])->name('con-customer.list');
    Route::post('/con-customer/get-room', [App\Http\Controllers\Admin\CustomerController::class, 'getRoom'])->name('con-customer.get-room');
    Route::post('/con-customer/get-floor', [App\Http\Controllers\Admin\CustomerController::class, 'getFloor'])->name('con-customer.get-floor');
    Route::post('/con-customer/add', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('con-customer.add');
    Route::post('/con-customer/set-active', [App\Http\Controllers\Admin\CustomerController::class, 'setActive'])->name('con-customer.set-active');
    Route::post('/con-customer/destroy', [App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('con-customer.destroy');
    Route::post('/con-customer/update', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('con-customer.update');

    Route::get('/location', [App\Http\Controllers\Admin\LocationController::class, 'index'])->name('location.index');
    Route::get('/location/list', [App\Http\Controllers\Admin\LocationController::class, 'list'])->name('location.list');
    Route::post('/location/add', [App\Http\Controllers\Admin\LocationController::class, 'store'])->name('location.add');
    Route::post('/location/set-active', [App\Http\Controllers\Admin\LocationController::class, 'setActive'])->name('location.set-active');
    Route::post('/location/destroy', [App\Http\Controllers\Admin\LocationController::class, 'destroy'])->name('location.destroy');
    Route::post('/location/update', [App\Http\Controllers\Admin\LocationController::class, 'update'])->name('location.update');

    Route::get('/store', [App\Http\Controllers\Admin\StoreController::class, 'index'])->name('store.index');
    Route::post('/store/add', [App\Http\Controllers\Admin\StoreController::class, 'store'])->name('store.add');
    // Route::post('/store/get-room', [App\Http\Controllers\Admin\StoreController::class, 'getRoom'])->name('store.get-Room');
    Route::post('/get-floors', [App\Http\Controllers\Admin\StoreController::class, 'getFloors'])->name('store.get-floors');
    Route::post('/get-rooms', [App\Http\Controllers\Admin\StoreController::class, 'getRooms'])->name('store.get-rooms');
    Route::post('/get-room', [App\Http\Controllers\Admin\StoreController::class, 'getRoom'])->name('store.get-room');
    Route::post('/get-store', [App\Http\Controllers\Admin\StoreController::class, 'getStore'])->name('store.get-store');
    Route::post('/store/update', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('store.update');
    Route::post('/store/destroy', [App\Http\Controllers\Admin\StoreController::class, 'destroy'])->name('store.destroy');
    Route::post('/store/set-active', [App\Http\Controllers\Admin\StoreController::class, 'setActive'])->name('store.set-active');
//
    Route::post('/store/listf1', [App\Http\Controllers\Admin\StoreController::class, 'listF1'])->name('store.listf1');
    // Route::get('/store/listf2', [App\Http\Controllers\Admin\StoreController::class, 'listF2'])->name('store.listf2');
    // Route::get('/store/listf3', [App\Http\Controllers\Admin\StoreController::class, 'listF3'])->name('store.listf3');
    Route::get('/print-doc1', [App\Http\Controllers\Admin\StoreController::class, 'printDoc1'])->name('store.print-doc1');
    Route::get('/print-doc2', [App\Http\Controllers\Admin\StoreController::class, 'printDoc2'])->name('store.print-doc2');
    Route::get('/print-doc3', [App\Http\Controllers\Admin\StoreController::class, 'printDoc3'])->name('store.print-doc3');
    Route::get('/doc1', [App\Http\Controllers\Admin\StoreController::class, 'print1'])->name('store.prints.doc1');
    Route::get('/doc2', [App\Http\Controllers\Admin\StoreController::class, 'print2'])->name('store.prints.doc2');
    Route::get('/doc3', [App\Http\Controllers\Admin\StoreController::class, 'print3'])->name('store.prints.doc3');

});

Route::get('/pages-maintenance', [App\Http\Controllers\Controller::class, 'pagesmaintenance'])->name('maintenance');
Route::get('/404', [App\Http\Controllers\Controller::class, 'pageNotFond'])->name('404');

Route::get('/condition', [App\Http\Controllers\User\RegisterCondition::class, 'index'])->name('condition');
Route::post('/list-condition', [App\Http\Controllers\User\RegisterCondition::class, 'condition'])->name('condition-list');
Route::get('/list-condition-page', [App\Http\Controllers\User\RegisterCondition::class, 'showConditionPage'])->name('list-condition-page');

Route::post('/set-saved-id', [App\Http\Controllers\User\RegisterCondition::class, 'setSavedId'])->name('set.saved.id');
Route::get('/list-condition/view-doc', [App\Http\Controllers\User\RegisterCondition::class, 'viewListDoc'])->name('condition.view-doc');

Route::post('/list-condition/store/add', [App\Http\Controllers\User\RegisterCondition::class, 'store'])->name('condition.store');
Route::post('/list-condition/check-phone', [App\Http\Controllers\User\RegisterCondition::class, 'checkPhone'])->name('condition.check-phone');
Route::post('/list-condition/check-personal', [App\Http\Controllers\User\RegisterCondition::class, 'checkPersonal'])->name('condition.check-personal');

Route::get('/all-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
