<?php
use Illuminate\Support\Facades\Route;



// authentication
Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']); //register
Route::post('verify', [\App\Http\Controllers\API\AuthController::class, 'verify']); //verify
Route::post('reset', [\App\Http\Controllers\API\AuthController::class, 'resetCode']); //reset_code
Route::post('resend', [\App\Http\Controllers\API\AuthController::class, 'resendCode']); //resend_code
Route::post('reset-password', [\App\Http\Controllers\API\AuthController::class, 'resetPassword']); //reset password
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'Login']); //login
Route::get('settings',         [\App\Http\Controllers\API\SettingController::class,'index']); //relations

// list of drops
Route::get('cities', [\App\Http\Controllers\API\SettingController::class, 'cities']); //cities
Route::get('areas/{id}', [\App\Http\Controllers\API\SettingController::class, 'areas']); //states
Route::get('states/{id}', [\App\Http\Controllers\API\SettingController::class, 'states']); //states
Route::get('services', [\App\Http\Controllers\API\ServiceController::class, 'index']); //services
Route::get('all-services-with-subservices', [\App\Http\Controllers\API\ServiceController::class, 'allServiceWithSubServices']); //all-services-with-subservices
Route::get('subservices/{service}', [\App\Http\Controllers\API\ServiceController::class, 'getSubService']); //subservices


Route::middleware(['auth:sanctum' , 'bindings'])->group( function () {

    // user setting

    Route::get('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']); // logout
    Route::post('user-update', [\App\Http\Controllers\API\AuthController::class, 'update']); //update user
    Route::get('user-profile', [\App\Http\Controllers\API\AuthController::class, 'profile']); // user
    Route::get('user-delete', [\App\Http\Controllers\API\AuthController::class, 'delete']); //delete user

    
    
    Route::get('notifications',         [\App\Http\Controllers\API\NotificationController::class,'userNotifications']);
    Route::post('delete-notification',  [\App\Http\Controllers\API\NotificationController::class,'DeleteNotification']);
});
