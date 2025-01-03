<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\front\MainController;
use App\Http\Controllers\web\BloodTypeController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\CountryController;
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
use App\Http\Middleware\RedirectIfNotClient;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::controller(MainController::class)->group(function () {
        // webiste routes 
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about'); //about the app
        Route::get('/contact-us', 'showContactForm')->name('front.contact.show');
        Route::post('/contact-us', 'submitContact')->name('front.contact.submit');



        Route::get('/donation-requests', 'requests')->name('donation-requests');
        Route::get('/donation-requests/{request}', 'showRequest');


        Route::get('/posts', 'listPosts')->name('posts');
        Route::get('/posts/{post}', 'showPost');
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
    Route::middleware('guest:web-client')->controller(AuthController::class)->group(function () {
        Route::get('/client-register', 'showClientRegisterForm')->name('client.register');
        Route::post('/client-register', 'clientRegister')->name('client.register.submit');

        Route::get('/client-login', [AuthController::class, 'showClientLoginForm'])->name('client.login');
        Route::post('/client-login', [AuthController::class, 'clientLogin'])->name('client.login.submit');

        Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('client.forgot');
        Route::post('/forgot-passowrd', [AuthController::class, 'forgotPassword'])->name('client.forgot.submit');

        Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('client.reset');
        Route::post('/reset-passowrd', [AuthController::class, 'resetPassword'])->name('client.reset.submit');
    });

    Route::middleware('auth:web-client')->group(function () {
        Route::post('/client-logout', [AuthController::class, 'clientLogout'])->name('client.logout');
        Route::get('/client-profile', [AuthController::class, 'showProfile'])->name('client.profile');
        Route::patch('/client-profile', [AuthController::class, 'profile'])->name('client.profile.update');

        Route::get('/donation-requests-create', [MainController::class, 'requestCreateForm'])->name('client.request.create');
        Route::post('/donation-requests-create', [MainController::class, 'requestCreateSubmit'])->name('client.request.createSubmit');


        Route::post('/toggle-favourite', [MainController::class, 'toggleFavourite'])->name('client.toggleFavourite');
        Route::get('/my-favourite', [MainController::class, 'myFavourite'])->name('client.myFavourite');


        Route::get('/notification-setting', [MainController::class, 'showNotificationSettingPage'])->name('client.notificationSetting');
        Route::patch('/notification-setting', [MainController::class, 'updateNotificationSetting'])->name('client.notificationSetting.update');
    });




    require __DIR__ . '/auth.php';
});
// website auth routes


Route::get('/country/import', [CountryController::class, 'import']);
Route::post('/country/import', [CountryController::class, 'importSubmit']);
