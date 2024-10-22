@extends('front.layouts.master')
@section('title','About Us')

@section('content')
  <!--inside-article-->
<div class="who-are-us">
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">من نحن</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo">
                    <img src="{{asset('front/assets/imgs/logo.png')}}">
                </div>
                <div class="text">
                    <p>
                       {{ $setting->about_app}}
                    </p>
                    <p>
                        {{ $setting->about_app}}                    </p>
                    <p>
                        {{ $setting->about_app}}                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection