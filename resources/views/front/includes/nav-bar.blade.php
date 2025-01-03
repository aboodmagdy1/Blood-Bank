<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('front/assets/imgs/logo.png') }}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">@lang('Home')<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">@lang('About Blood Bank')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts') }}"> @lang('Articles')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('donation-requests') }}">@lang('Donation Requests')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">@lang('About Us') </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact.show') }}"> @lang('Contact Us')</a>
                    </li>
                </ul>

                <!--not a member-->
                @guest('web-client')
                    <div class="accounts">
                        <a href="{{ route('client.register') }}" class="create">@lang('Register') </a>
                        <a href="{{ route('client.login') }}" class="signin">@lang('Login')</a>
                    </div>
                @endguest

                <!--I'm a member  -->

                @auth('web-client')
                    <a href="{{ route('client.request.create') }}" class="donate">
                        <img src="{{ asset('front/assets/imgs/transfusion.svg') }}">
                        <p>طلب تبرع</p>
                    </a>
                @endauth


            </div>
        </div>
    </nav>
</div>
