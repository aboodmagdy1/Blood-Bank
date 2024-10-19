<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientPasswordResetController;
use App\Http\Controllers\Api\DonationRequestController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    /**--------------------------------General Apis     ---------------------------------- */
    Route::controller(MainController::class)->group(function () {
        Route::get('/governorates',  'governorates');
        Route::get('/cities',  'cities');
        Route::get('/blood-types', 'bloodTypes');
        Route::get('/categories', 'categories');
        Route::get('/settings', 'settings')->middleware('auth:api');
        Route::get('/contact', 'contact')->middleware('auth:api');
        Route::get('/contact', 'contactInfo')->middleware('auth:api');
        Route::post('/contact', 'contact')->middleware('auth:api');
        Route::get('/about', 'about')->middleware('auth:api');
    });

    /**-------------------------------- Post Api    ---------------------------------- */
    Route::controller(PostController::class)->middleware('auth:api')->group(function () {
        Route::get('/posts', 'index');
        Route::get('/posts/{id}', 'show');
        Route::get('/favourites', 'myFavourites');
        Route::post('/toggle-favourites', 'toggleFavourite');
    });


    /**-------------------------------- Donation Request Api    ---------------------------------- */
    Route::controller(DonationRequestController::class)->middleware('auth:api')->group(function () {
        Route::get('/donation-requests', 'index');
        Route::post('/donation-requests', 'store');
    });
    /**-------------------------------- Notification Api    ---------------------------------- */
    Route::controller(NotificationController::class)->middleware('auth:api')->group(function () {
        Route::post('/register-token', 'registerToken');
        Route::post('/remove-token', 'removeToken');
        Route::get('/my-notifications', 'myNotification');
    });


    /**---------------------------------Auth Api ------------------------------------------ */
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'resetPassword');

        // --------------------------------Authnticated Routes --------------------------------
        Route::middleware('auth:api')->group(function () {
            Route::post('/logout', 'logout')->middleware('auth:api');
            Route::get('/profile', 'profile')->middleware('auth:api');
            Route::patch('/edit-profile', 'editProfile')->middleware('auth:api');
            Route::get('/notification-settings', 'getNotificationSettings')->middleware('auth:api');
            Route::patch('/notification-settings', 'editNotificationSettings')->middleware('auth:api');
        });
    });
});
