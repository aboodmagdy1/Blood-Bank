@inject('BloodType','App\Models\BloodType' )
@inject('City','App\Models\City' )
@extends('front.layouts.master')
@section('title',"Donation Requests")


@section('content')
    <div class="donation-requests">
        <!--inside-article-->
            <div class="all-requests">
                <div class="container">
                    <div class="path">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                            </ol>
                        </nav>
                    </div>
                
                    <!--requests-->
                    <div class="requests">
                        <div class="head-text">
                            <h2>طلبات التبرع</h2>
                        </div>
                        <div class="content">
                            <form class="row filter" action="{{route('donation-requests')}}" method="GET">
                                @csrf
                                <div class="col-md-5 blood">
                                    <div class="form-group">
                                        <div class="inside-select">
                                            <select class="form-control" id="exampleFormControlSelect1" name="blood-type-id">
                                                <option selected disabled>اختر فصيلة الدم</option>
                                                @foreach ($BloodType->all() as $type )
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 city">
                                    <div class="form-group">
                                        <div class="inside-select">
                                            <select class="form-control" id="exampleFormControlSelect1" name="city-id">
                                                <option selected disabled>اختر المدينة</option>
                                                @foreach ($City->all() as $city )
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 search">
                                    <button type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="patients">
                               @foreach ($requests as $request )
                               <div class="details">
                                <div class="blood-type">
                                    <h2 dir="ltr">{{$BloodType->find($request->blood_type_id)->name}}</h2>
                                </div>
                                <ul>
                                    <li><span>اسم الحالة:</span> {{$request->patient_name}}</li>
                                    <li><span>مستشفى:</span> {{$request->hospital_name}} </li>
                                    <li><span>المدينة:</span> {{$City->find($request->city_id)->name}}</li>
                                </ul>
                                <a href="{{url('donation-requests/'.$request->id)}}">التفاصيل</a>
                            </div>
                               @endforeach
                            </div>
                            <div class="pages">
                                <nav aria-label="Page navigation example" dir="ltr">
                                    <ul class="pagination">
                                        {{ $requests->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 4 style pagination -->
                                    </ul>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection