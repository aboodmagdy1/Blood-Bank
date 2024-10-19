<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">        <!-- AdminLTE Fonts and Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}" />

        <!-- AdminLTE Stylesheets -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />

        <style>
           
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
    
            .main-sidebar {
                width: 250px; /* Adjust width as needed */
                flex-shrink: 0;
                background-color: #343a40; /* Ensure background color matches sidebar-dark-primary */
            }
    
           
            .main-navbar {
                z-index: 1030; /* Ensure navbar is above other elements */
            }
            @media (max-width: 768px) {
                .main-sidebar {
                    width: 200px;
                }
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- jQuery (necessary for AdminLTE) -->
        <script src="{{ asset('dist/plugins/jquery.min.js') }}"></script>
    </head>

    <body class="hold-transition sidebar-mini">
        
        <div class="wrapper">

            
            <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')    
                <!-- Page Heading -->
                @isset($header)
                <header class="bg-white shadow text-center">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset
                <x-aside/>
                <!-- Page Content -->
                <main>
                        {{ $slot }}
                </main>
                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block"><b>Version</b> 3.2.0</div>
                    <strong
                      >Copyright &copy; 2014-2021
                      <a href="https://adminlte.io">AdminLTE.io</a>.</strong
                    >
                    All rights reserved.
                </footer>
                
            </div>
         </div>

    </body>

    <!-- Bootstrap 4 -->
<script src="{{ asset('dist/bootstrap/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes (Optional) -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- Additional Scripts (if needed) -->
@stack('scripts') 
</html>


