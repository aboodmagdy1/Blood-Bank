<?php

use App\Http\Controllers\web\BloodTypeController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\CityController;
use App\Http\Controllers\web\ClientController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\GovernorateController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\RequestController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\SettingController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');





// Dashboard Routes 
Route::middleware('auth')->group(function () {
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
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
