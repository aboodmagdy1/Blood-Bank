@inject('GovModel','App\Models\Governorate' )
@inject('BloodType','App\Models\BloodType')
@extends('front.layouts.master')
@section('title','Register Page')



@section('content')
 
    {{-- get auth user --}}
    @guest('web-client')
    <div class="create">
        <!--form-->
        <div class="form">
           <div class="container">
               <div class="path">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                           <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                       </ol>
                   </nav>
               </div>
               <div class="account-form">
                   <form action="{{route('client.register')}}" method="POST">
                       @csrf

                       <x-text-input id="name" class="form-control"  type="text" name="name" :value="old('name')"    placeholder="الإسم"/>

                       @error('name')
                         <x-input-error :messages="$message" class="text-red"/>
                       @enderror


                       <x-text-input id="email" class="form-control"  type="email" name="email" :value="old('email')"    placeholder=" البريد الإلكترونى"  />
                       @error('email')
                         <x-input-error :messages="$message" />
                       @enderror

                       <x-text-input :value="old('d_o_b')" placeholder="تاريخ الميلاد" class="form-control" type="date" onfocus="(this.type='date')" id="date" name='d_o_b'  placeholder=" البريد الإلكترونى"  />
                       @error('d_o_b')
                         <x-input-error :messages="$message" />
                       @enderror

                       
                       <select class="form-control" id="bloodTypes" name="blood_type_id" :value="old('blood_type_id')">
                           <option selected disabled hidden value="">فصيلة الدم</option>
                           @foreach ($BloodType->all() as $type )
                               <option value="{{$type->id}}">{{$type->name}}</option>                              
                           @endforeach
                       </select>
                       @error('blood_type_id')
                         <x-input-error :messages="$message" />
                       @enderror


                       <select class="form-control" id="governorates" name="governorate_id" >
                           <option selected disabled hidden value="old('governorate_id')">المحافظة</option>
                           @foreach ($GovModel->all() as $gov )
                               <option value="{{$gov->id}}">{{$gov->name}}</option>                              
                           @endforeach
                       </select>

                           @error('governorate_id')
                           <x-input-error :messages="$message" />
                           @enderror
                           
                       <select class="form-control" id="cities" name="city_id" >
                           <option  selected disabled hidden value="">المدينة</option>
                       </select>

                           @error('city_id')
                           <x-input-error :messages="$message" />
                           @enderror


                       <x-text-input name='phone' type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="رقم الهاتف" />

                       @error('phone')
                       <x-input-error :messages="$message" />
                       @enderror


                       <x-text-input name='last_donation_date' placeholder="آخر تاريخ تبرع" class="form-control" type="text" onfocus="(this.type='date')" id="date"/>

                           @error('last_donation_date')
                           <x-input-error :messages="$message" />
                           @enderror


                           <x-text-input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور"/>

                           @error('password')
                           <x-input-error :messages="$message" />
                           @enderror
                       
                           <x-text-input name='password_confirmation' type="password" class="form-control" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور"/>

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

    @endguest
@stop

@push('scripts')
    <script>
       $(document).ready(function(){
        $('#governorates').on('change',function(){
            var gov_id = $(this).val();
            if(gov_id){
                $.ajax({
                    url:'{{url("api/v1/cities?governorate_id=")}}'+gov_id,
                    type:'GET',
                    headers:{'X-CSRF-TOKEN':'{{csrf_token()}}'},
                    success: function(data){
                        if(data.status == 1){
                            
                        $('#cities').empty();
                        $('#cities').append(
                            '<option selected disabled hidden value="">اختر مدينه</option>'
                        );
                        $.each(data.data,function(key,city){
                            $('#cities').append('<option value="'+city.id+'">'+city.name+'</option>')
                        })
                        }
                    },
                    error: function(jqXHR, textStatus, errorMessage){
                       alert(errorMessage);

                    }
                })
            }
            else {
                $('#cities').empty();
                $('#cities').append('<option selected disabled hidden value="">المدينة</option>');
            }
        })
       })
    </script>
@endpush