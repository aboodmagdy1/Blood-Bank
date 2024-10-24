@inject('GovModel','App\Models\Governorate' )
@inject('BloodModel','App\Models\BloodType' )
@extends('front.layouts.master')
@section('title',"Update Notification Settings")

@section('content')
<div class="signin-account">
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">اعدادات الاشعارات </li>
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
                <form action="{{route('client.notificationSetting.update')}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <x-input-label class="text-primary" for='governorate_list' value="المحافظات"/>
                        <div class="row">
                            @foreach ($GovModel->all() as $governorate )
                                <div class="col-sm-3">
                                     <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="governorate_list[]" value="{{$governorate->id}}"
                                            @if(auth()->user()->governorates->contains($governorate->id)) checked @endif
                                            >
                                            {{$governorate->name}}
                                        </label>

                                     </div>
                                </div>
                            @endforeach
                        </div>
                        @error('governorate_list')
                        <x-input-error :messages="$message" />
                      @enderror 
                    </div>

                    <div class="form-group">
                        <x-input-label class="text-danger" for='governorate_list' value="فصائل الدم"/>
                        <div class="row">
                            @foreach ($BloodModel->all() as $type )
                                <div class="col-sm-3">
                                     <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="type_list[]" value="{{$type->id}}"
                                            @if(auth()->user()->bloodTypes->contains($type->id)) checked @endif
                                            >
                                            {{$type->name}}
                                        </label>

                                     </div>
                                </div>
                            @endforeach
                        </div>
                        @error('type_list')
                        <x-input-error :messages="$message" />
                      @enderror 
                    </div>
                  
                    <div class="row buttons">
                        <div class="col-md-8 left">
                            <button type="submit" class="btn btn-dark">  تغير اعدادات الاشعارات </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection
