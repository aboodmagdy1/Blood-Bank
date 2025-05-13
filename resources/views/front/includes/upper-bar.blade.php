    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="language">
                        <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="ar active">عربى</a>
                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="en inactive">EN</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social">
                        <div class="icons">
                        </div>
                    </div>
                </div>

                <!-- not a member-->
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                        </div>
                    </div>

                    @auth('web-client')
                        <!--I'm a member -->
                        <div class="member">
                            <p class="welcome">مرحباً بك</p>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->guard('web-client')->user()->name }}
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        <i class="fas fa-home"></i>
                                        الرئيسية
                                    </a>
                                    <a class="dropdown-item" href="{{ route('client.profile') }}">
                                        <i class="far fa-user"></i>
                                        معلوماتى
                                    </a>
                                    <a class="dropdown-item" href="{{ route('client.notificationSetting') }}">
                                        <i class="far fa-bell"></i>
                                        اعدادات الاشعارات
                                    </a>
                                    <a class="dropdown-item" href="{{ route('client.myFavourite') }}">
                                        <i class="far fa-heart"></i>
                                        المفضلة
                                    </a>

                                    <a class="dropdown-item" href="{{ route('front.contact.show') }}">
                                        <i class="fas fa-phone-alt"></i>
                                        تواصل معنا
                                    </a>
                                    <form action="{{ route('client.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" href="logout" type="submit">
                                            <i class="fas fa-sign-out-alt"></i>
                                            تسجيل الخروج
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
