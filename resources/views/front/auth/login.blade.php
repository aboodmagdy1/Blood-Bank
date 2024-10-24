@extends('front.layouts.master')
@section('title',"Login Page")

@section('content')
<div class="signin-account">
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                <form action="{{route('client.login.submit')}}"  method="POST">
                    @csrf
                    <div class="logo">
                        <img src="{{asset('front/assets/imgs/logo.png')}}">
                    </div>
                    <div class="form-group">

                        <x-text-input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  :value="old('email')"    placeholder="البريد الالكتروني"/>
                            @error('email')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror

                    </div>
                    <div class="form-group">
                        <x-text-input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور"  :value="old('password')"    />
                            @error('password')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror
                    </div>
                    <div class="row options">
                        <div class="col-md-6 remember">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rebember">
                                <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                
                            </div>
                        </div>
                        <div class="col-md-6 forgot">
                            <img src="{{asset('front/assets/imgs/complain.png')}}">
                            <a href="{{route('client.forgot')}}">هل نسيت كلمة المرور</a>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-6  create ">
                                <button type="submit" class="btn btn-success p-10 w-10"> دخول</button>
                        </div>
                        <div class="col-md-6 left">
                            <a href="{{route('client.register')}}">انشاء حساب جديد</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@stop