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
        // Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
        // Route::post('/register-store', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register-store');
        // Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
        // Route::get('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');

        Route::middleware(['auth','agent','preventBackHistory'])->group(function () {
                Route::get('/', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
                Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');
                // Route::get('/search', [App\Http\Controllers\Agent\WorkController::class, 'search'])->name('search');
        });
  
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'preventBackHistory'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/change-password', [App\Http\Controllers\Controller::class, 'changePassword'])->name('change-password');

        Route::get('/add-room', [App\Http\Controllers\Admin\AddRoomController::class, 'index'])->name('room.index');
        Route::get('/add-room/listf1', [App\Http\Controllers\Admin\AddRoomController::class, 'listF1'])->name('room.listf1');
        Route::get('/add-room/listf2', [App\Http\Controllers\Admin\AddRoomController::class, 'listF2'])->name('room.listf2');
        Route::get('/add-room/listf3', [App\Http\Controllers\Admin\AddRoomController::class, 'listF3'])->name('room.listf3');
        Route::post('/add-room/add', [App\Http\Controllers\Admin\AddRoomController::class, 'store'])->name('room.add');
        Route::post('/add-room/set-active', [App\Http\Controllers\Admin\AddRoomController::class, 'setActive'])->name('room.set-active');
        Route::post('/add-room/destroy', [App\Http\Controllers\Admin\AddRoomController::class, 'destroy'])->name('room.destroy');
        Route::post('/add-room/update', [App\Http\Controllers\Admin\AddRoomController::class, 'update'])->name('room.update');

        Route::get('/add-room-charge', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'index'])->name('room-charge.index');
        Route::get('/add-room-charge/list', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'list'])->name('room-charge.list');
        Route::post('/add-room-charge/add', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'store'])->name('room-charge.add');
        Route::post('/add-room-charge/set-active', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'setActive'])->name('room-charge.set-active');
        Route::post('/add-room-charge/destroy', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'destroy'])->name('room-charge.destroy');
        Route::post('/add-room-charge/update', [App\Http\Controllers\Admin\AddRoomChargeController::class, 'update'])->name('room-charge.update');


        Route::get('/store', [App\Http\Controllers\Admin\StoreController::class, 'index'])->name('store.index');
        Route::get('/store/listf1', [App\Http\Controllers\Admin\StoreController::class, 'listF1'])->name('store.listf1');
        Route::get('/store/listf2', [App\Http\Controllers\Admin\StoreController::class, 'listF2'])->name('store.listf2');
        Route::get('/store/listf3', [App\Http\Controllers\Admin\StoreController::class, 'listF3'])->name('store.listf3');

        Route::get('/print-doc1', [App\Http\Controllers\Admin\StoreController::class, 'printDoc1'])->name('store.print-doc1');
        Route::get('/print-doc2', [App\Http\Controllers\Admin\StoreController::class, 'printDoc2'])->name('store.print-doc2');
        Route::get('/print-doc3', [App\Http\Controllers\Admin\StoreController::class, 'printDoc3'])->name('store.print-doc3');

        Route::get('/doc1', [App\Http\Controllers\Admin\StoreController::class, 'print1'])->name('store.prints.doc1');
        Route::get('/doc2', [App\Http\Controllers\Admin\StoreController::class, 'print2'])->name('store.prints.doc2');
        Route::get('/doc3', [App\Http\Controllers\Admin\StoreController::class, 'print3'])->name('store.prints.doc3');

        Route::post('/store/add', [App\Http\Controllers\Admin\StoreController::class, 'store'])->name('store.add');
        Route::post('/store/update', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('store.update');
        Route::post('/store/destroy', [App\Http\Controllers\Admin\StoreController::class, 'destroy'])->name('store.destroy');
        Route::post('/store/set-active', [App\Http\Controllers\Admin\StoreController::class, 'setActive'])->name('store.set-active');

});

Route::get('/pages-maintenance', [App\Http\Controllers\Controller::class, 'pagesmaintenance'])->name('maintenance');
Route::get('/404', [App\Http\Controllers\Controller::class, 'pageNotFond'])->name('404');

Route::get('/list-condition', [App\Http\Controllers\User\RegisterCondition::class, 'index'])->name('condition');
Route::get('/list-condition/{id}', [App\Http\Controllers\User\RegisterCondition::class, 'condition'])->name('condition-list');
Route::get('/list-condition/view-doc-1/{id}', [App\Http\Controllers\User\RegisterCondition::class, 'viewListDoc'])->name('condition.view-doc-1');

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
