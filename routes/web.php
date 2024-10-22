<?php

use App\Http\Controllers\front\MainController;
use App\Http\Controllers\web\BloodTypeController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\CityController;
use App\Http\Controllers\web\ClientController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\GovernorateController;
use App\Http\Controllers\web\PermissionController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\RequestController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\SettingController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    // webiste routes 
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about'); //about the app
    Route::get('/contact-us', 'contact')->name('contact-us');
    Route::get('/donation-requests', 'requests')->name('donation-requests');
    Route::get('/donation-requests/{request}', 'showRequest');


    Route::get('/posts', 'posts')->name('posts');
    Route::get('/posts/{post}', 'showPost');

    Route::middleware('auth:client-web')->group(function () {
        // Favorite Posts , make favorites 
        Route::get('/toggle-favourite', 'toggleFavourite')->name('toggleFavourite');
        // create request 
        // show profile
        // edit profile
        // logout 
    });
});






// Dashboard Routes 
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Governorates
    Route::resource('governorate', GovernorateController::class);
    Route::resource('city', CityController::class);
    Route::resource('blood-type', BloodTypeController::class);
    Route::resource('donation-request', RequestController::class);

    Route::resource('client', ClientController::class);
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('contact', ContactController::class);
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Roles , Permissions , Users 
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});
require __DIR__ . '/auth.php';
