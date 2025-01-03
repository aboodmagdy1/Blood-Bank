<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class

        ]);
        // redirect users (admins) to dashboard if they authinticated an try to ex: login or any guest route 
        $middleware->redirectUsersTo(function () {

            if (Auth::guard('web')->check()) {
                return route('dashboard');
            } else if (Auth::guard('web-client')->check()) {
                return route('home');
            }
        });

        // if users are not authinticated route to login 
        $middleware->redirectGuestsTo(function () {
            // لو الاتنين مش عاملين لوج أول شرط دايما ب تروو  
            // لازم اميز بقي الروت + الجارد 

            if (request()->is('admin/*')) {

                if (Auth::guard('web')->guest()) {

                    return route('login');
                }
            } else if (Auth::guard('web-client')->guest()) {
                return route('client.login');
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
