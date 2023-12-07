<?php
use Illuminate\Support\Facades\Route;


Route::middleware(['bindings'])->group(function () {

    // authentication
    Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']); //register
    Route::post('verify', [\App\Http\Controllers\API\AuthController::class, 'verify']); //verify
    Route::post('reset', [\App\Http\Controllers\API\AuthController::class, 'resetCode']); //reset_code
    Route::post('resend', [\App\Http\Controllers\API\AuthController::class, 'resendCode']); //resend_code
    Route::post('reset-password', [\App\Http\Controllers\API\AuthController::class, 'resetPassword']); //reset password
    Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'Login']); //login
    Route::get('settings', [\App\Http\Controllers\API\SettingController::class, 'index']); //relations

    // list of drops
    Route::get('cities', [\App\Http\Controllers\API\SettingController::class, 'cities']); //cities
    Route::get('areas/{city}', [\App\Http\Controllers\API\SettingController::class, 'areas']); //states
    Route::get('states/{area}', [\App\Http\Controllers\API\SettingController::class, 'states']); //states
    Route::get('services', [\App\Http\Controllers\API\ServiceController::class, 'index']); //services
    Route::get('all-services-with-subservices', [\App\Http\Controllers\API\ServiceController::class, 'allServiceWithSubServices']); //all-services-with-subservices
    Route::get('subservices/{service}', [\App\Http\Controllers\API\ServiceController::class, 'getSubService']); //subservices

    // uploads
    Route::post('upload-image-resize', [\App\Http\Controllers\Api\AttachmentController::class, 'uploadImage']); //image
    Route::post(
        'upload-image-without-resize',
        [\App\Http\Controllers\Api\AttachmentController::class, 'uploadImageNoResize']
    ); //image
    Route::post('upload-file', [\App\Http\Controllers\Api\AttachmentController::class, 'uploadAttachment']); //file
    Route::middleware(['auth:sanctum'])->group(function () {

        // user setting

        Route::get('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']); // logout
        Route::post('update-profile', [\App\Http\Controllers\API\AuthController::class, 'updateProfile']); //update user
        Route::post('update', [\App\Http\Controllers\API\AuthController::class, 'update']); //update user
        Route::get('user-profile', [\App\Http\Controllers\API\AuthController::class, 'show']); // user
        Route::get('user-delete', [\App\Http\Controllers\API\AuthController::class, 'delete']); //delete user
        //addresses
        Route::post('/addresses', [\App\Http\Controllers\API\AddressController::class, 'store']);
        Route::get('/addresses/{address}', [\App\Http\Controllers\API\AddressController::class, 'show']);
        Route::get('/update-addresses/{address}', [\App\Http\Controllers\API\AddressController::class, 'update']);
        Route::get('/user-addresses', [\App\Http\Controllers\API\AddressController::class, 'addresses']);
        Route::get('addresses/delete/{address}', [\App\Http\Controllers\Api\AddressController::class, 'destroy']);
        Route::get('times/{day}', [\App\Http\Controllers\Api\TimeController::class, 'getTimes']);

        Route::get('notifications', [\App\Http\Controllers\API\NotificationController::class, 'userNotifications']);
        Route::post('delete-notification', [\App\Http\Controllers\API\NotificationController::class, 'DeleteNotification']);
    });
});
