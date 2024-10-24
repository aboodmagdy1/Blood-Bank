@inject('GovModel','App\Models\Governorate' )
@inject('BloodType','App\Models\BloodType')
@extends('front.layouts.master')
@section('title','Register Page')



@section('content')
 
    {{-- get auth user --}}
    @auth('web-client')
    <div class="create">
        <!--form-->
        <div class="form">
           <div class="container">
               <div class="path">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                           <li class="breadcrumb-item active" aria-current="page"> انشاء طلب جديد</li>
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
                   <form action="{{route('client.request.createSubmit')}}" method="POST">
                       @csrf

                       <x-text-input  id="patient_name'" class="form-control"  type="text" name="patient_name" :value="old('patient_name')"    placeholder="اسم المريض"/>

                       @error('patient_name')
                         <x-input-error :messages="$message" class="text-red"/>
                       @enderror


                       <x-text-input id="patient_age" class="form-control"  type="text" name="patient_age" :value="old('patient_age')"    placeholder=" عمر المريض"  />
                       @error('patient_age')
                         <x-input-error :messages="$message" />
                       @enderror

                       <x-text-input id="patient_phone" class="form-control"  type="text" name="patient_phone" :value="old('patient_phone')"    placeholder=" رقم هاتف المرافق "  />
                       @error('patient_phone')
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

                       <select class="form-control" id="cities" name="city_id" >
                           <option  selected disabled hidden value="">المدينة</option>
                       </select>

                           @error('city_id')
                           <x-input-error :messages="$message" />
                           @enderror


                       <x-text-input name='bags_num' type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عدد الأكياس" />

                       @error('bags_num')
                       <x-input-error :messages="$message" />
                       @enderror

                       <x-text-input name='hospital_name' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="اسم المستشفى" />

                       @error('hospital_name')
                       <x-input-error :messages="$message" />
                       @enderror

                       <x-text-input name='hospital_address' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان المستشفى" />

                       @error('hospital_address')
                       <x-input-error :messages="$message" />
                       @enderror
                       <x-text-input name='details' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="تفاصيل عن الحاله" />

                       @error('details')
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