@inject('GovModel','App\Models\Governorate' )
@inject('BloodType','App\Models\BloodType')
@extends('front.layouts.master')
@section('title','Register Page')



@section('content')
 
    @auth('web-client')

    
    <div class="create">
        <!--form-->
        <div class="form">
           <div class="container">
               <div class="path">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                           <li class="breadcrumb-item active" aria-current="page">معلوماتي</li>
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
               <div class="account-form">
                   <form action="{{route('client.profile.update')}}" method="POST">
                       @csrf
                        @method('PATCH')
                       <x-text-input id="name" class="form-control"  type="text" name="name" :value="old('name',$client)"    placeholder="الإسم"/>

                       @error('name')
                         <x-input-error :messages="$message" class="text-red"/>
                       @enderror

                       <select class="form-control" id="bloodTypes" name="blood_type_id" ">
                           <option selected disabled hidden :value="old('blood_type_id',$client) >فصيلة الدم</option>
                           @foreach ($BloodType->all() as $type )
                               <option value="{{$type->id}}">{{$type->name}}</option>                              
                           @endforeach
                       </select>

                       @error('blood_type_id')
                         <x-input-error :messages="$message" />
                       @enderror

                       <x-text-input :value="old('phone',$client)" name='phone' type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="رقم الهاتف" />

                       @error('phone')
                       <x-input-error :messages="$message" />
                       @enderror


                       <x-text-input :value="old('last_donation_date',$client)" name='last_donation_date' placeholder="آخر تاريخ تبرع" class="form-control" type="text" onfocus="(this.type='date')" id="date"/>

                           @error('last_donation_date')
                           <x-input-error :messages="$message" />
                           @enderror


                           <x-text-input :value="old('password',$client)" name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور"/>

                           @error('password')
                           <x-input-error :messages="$message" />
                           @enderror
                       
                           <x-text-input :value="old('password',$client)" name='password_confirmation' type="password" class="form-control" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور"/>

                           @error('password')
                           <x-input-error :messages="$message" />
                           @enderror
                       

                       
                       <div class="create-btn">
                           <input type="submit" value="إنشاء"></input>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       
       
    </div>
    @endauth


  
@stop
