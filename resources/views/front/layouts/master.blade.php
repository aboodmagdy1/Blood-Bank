<!doctype html>
<html lang="en" dir="rtl">
    <head>
       @include('front.includes.head')
    
    </head>
    <body>
        {{-- Upper-bar --}}
        @include('front.includes.upper-bar')
        
        
        <!--nav-->
         @include('front.includes.nav-bar')
        
        @yield('content')
    
        <!--footer-->
        @include('front.includes.footer')    
       @include('front.includes.footer-scripts')
    </body>
</html>