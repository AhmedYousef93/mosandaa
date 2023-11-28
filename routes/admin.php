<?php

use Illuminate\Support\Facades\Route;


Route::get('admin/home', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('adminhome');
Route::get('admin', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [\App\Http\Controllers\Admin\LoginController::class, 'login']);
Route::get('lang/{local}', [\App\Http\Controllers\Admin\AdminController::class, 'lang'])->name('lang');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except(['show']);
    Route::resource('aboutus', \App\Http\Controllers\Admin\AboutController::class)->except(['show']);
    Route::resource('contactus', \App\Http\Controllers\Admin\ContactController::class)->except(['create', 'edit']);
    Route::resource('terms', \App\Http\Controllers\Admin\TermsController::class)->except(['show']);
    Route::resource('usages', \App\Http\Controllers\Admin\UsageController::class)->except(['show']);
    Route::resource('privecy', \App\Http\Controllers\Admin\PrivecyController::class)->except(['show']);
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqsController::class)->except(['show']);
    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->except(['show']);
    Route::resource('admins', \App\Http\Controllers\Admin\AdminsController::class)->except(['show']);
    Route::resource('cities', \App\Http\Controllers\Admin\CityController::class)->except(['show']);
    Route::resource('areas', \App\Http\Controllers\Admin\AreaController::class)->except(['show']);
    Route::get('/areas/get-by-city', [\App\Http\Controllers\Admin\AreaController::class, 'getAreasByCity'])->name('areas.get.by.city');
    

    Route::resource('states', \App\Http\Controllers\Admin\StateController::class)->except(['show']);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->except(['show']);

    Route::get('/get-subservice-data/{subservice}', [\App\Http\Controllers\Admin\SubServiceController::class, 'getSubserviceData']);
    Route::put('/subservice/{subservice}', [\App\Http\Controllers\Admin\SubserviceController::class, 'update']);
    Route::get('orders/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'sellerOrders'])->name('orderseller');
    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting');
    Route::post('setting', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('updatesetting');
    Route::get('useractive', [\App\Http\Controllers\Admin\UsersController::class, 'UserStatus'])->name('useractive');
    Route::get('adminactive', [\App\Http\Controllers\Admin\AdminsController::class, 'AdminStatus'])->name('adminactive');
    Route::get('contactusDetail', [\App\Http\Controllers\Admin\ContactController::class, 'contactusDetails'])->name('contactusdetails');
    Route::post('logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

});