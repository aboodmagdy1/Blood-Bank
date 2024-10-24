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
                        <li class="breadcrumb-item active" aria-current="page"> انشاء كلمة المرور جديده</li>
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
            <div class="signin-form">
                <form action="{{route('client.reset.submit')}}"  method="POST">
                    @csrf
                    <div class="logo">
                        <img src="{{asset('front/assets/imgs/logo.png')}}">
                    </div>
                    <div class="form-group">

                         <x-text-input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  :value="old('email')"    placeholder="البريد الالكتروني"/>
                            @error('email')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror

                            <x-text-input name='reset_code' type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  :value="old('reset_code')"    placeholder="رقم التأكيد"/>
                            @error('reset_code')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror

                            <x-text-input name='password' type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  :value="old('password')"    placeholder="كلمة المرور الجديده"/>
                            @error('password')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror

                            <x-text-input name='password_confirmation' type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  :value="old('password')"    placeholder="كلمة المرور الجديده"/>
                            @error('password')
                                <x-input-error :messages="$message" class="text-red"/>
                            @enderror

                    </div>
                    
                    <button class="col-md-5 btn btn-success">اعادة انشاء كلمة السر </button>
                    
                </form>
            </div>
        </div>
    </div>
    
</div>
@stop