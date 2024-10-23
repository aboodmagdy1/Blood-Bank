@extends('front.layouts.master')
@section('title','Contact Us')

@section('content')
        
    <div class="contact-us ">
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{asset('front/assets/imgs/logo.png')}}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>الجوال:</span> {{$setting->phone}}</li>
                                    <li><span>البريد الإلكترونى:</span> {{$setting->email}}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{$setting->fb_link}}"><img src="{{asset('front/assets/imgs/001-facebook.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->tw_link}}"><img src="{{asset('front/assets/imgs/002-twitter.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->youtube_link}}"><img src="{{asset('front/assets/imgs/003-youtube.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->insta_link}}"><img src="{{asset('front/assets/imgs/004-instagram.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->watts_link}}"><img src="{{asset('front/assets/imgs/005-whatsapp.svg')}}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            <form accept="{{route('front.contact.submit')}}" method="POST">
                                @csrf
                                <x-text-input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الإسم" name="name" :value="old('name')" />
                                @error('name')
                                    <x-input-error :messages="$message" />
                                @enderror

                                <x-text-input type="email" class="form-control" id="exampleFormControlInput1" placeholder="البريد الإلكترونى" name="email" :value="old('email')" />
                                @error('email')
                                    <x-input-error :messages="$message" />
                                @enderror

                                <x-text-input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الجوال" name="phone" :value="old('phone')" />
                                @error('phone')
                                    <x-input-error :messages="$message" />
                                @enderror

                                <x-text-input type="text" class="form-control" id="exampleFormControlInput1" placeholder="عنوان الرسالة" name="subject" :value="old('subject')" />
                                @error('subject')
                                    <x-input-error :messages="$message" />
                                @enderror

                                <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                @error('message')
                                <x-input-error :messages="$message" />
                                @enderror
                                
                                <button type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection