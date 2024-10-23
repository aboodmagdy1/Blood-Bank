@inject('Post','App\Models\Post' )
@inject('BloodType','App\Models\BloodType' )
@inject('City','App\Models\City' )
@extends('front.layouts.master')

@section('title','Blood Bank')


@section('content')
     <!--intro-->
     <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص. 
                            </p>
                            <a href="{{route('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص. 
                            </p>
                            <a href={{route('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي. 
                            </p>
                            <a href="{{route('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>بنك الدم</span> 
                    {{$setting->about_app}}
                </p>
            </div>
            
        </div>
    </div>
    
    <!--articles-->
    <div class="articles" id='articles-section'>
        <div class="container title">
            <div class="head-text">
                <h2>المقالات</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                      @foreach ($Post->all() as $post )
                      <div class="card">
                        <div class="photo">
                            <img src="{{asset('front/assets/imgs/p2.jpg')}}" class="card-img-top" alt="...">
                            <a href="{{url('posts/'.$post->id)}}" class="click">المزيد</a>
                        </div>
                        @auth('web-client')
                        <button href="#" class="favourite">
                            <i id="{{$post->id}}" class="text-danger far fa-heart {{$post->is_favourite? 'fas':''}}" onclick="toggleFavourite(this)"></i>
                        </button>
                            
                        @endauth

                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">
                               {{ $post->content}}
                            </p>
                        </div>
                    </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter" action="/" method="GET">
                    @csrf
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1" name="blood-type-id">
                                    <option disabled {{ request('blood-type-id') ? '' : 'selected' }}>اختر فصيلة الدم</option>
                                    @foreach ($BloodType->all() as $type )
                                        <option value="{{ $type->id }}" {{ request('blood-type-id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
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
                                    <option disabled {{ request('city-id') ? '' : 'selected' }}>اختر المدينة</option>
                                    @foreach ($City->all() as $city )
                                        <option value="{{ $city->id }}" {{ request('city-id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
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
                            <li><span>مستشفى:</span>{{$request->hospital_name}}</li>
                            <li><span>المدينة:</span> {{$City->find($request->city_id)->name}}</li>
                        </ul>
                        <a href="{{url('donation-requests/'.$request->id)}}">التفاصيل</a>
                    </div>
                    @endforeach
                </div>
                <div class="more">
                    <a href="{{route('donation-requests')}}">المزيد</a>
                </div>
            </div>
        </div>
    </div>
    
    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>اتصل بنا</h3>
                </div>
                <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{asset('front/assets/imgs/whats.png')}}">
                        <p dir="ltr">+002  1215454551</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>تطبيق بنك الدم</h3>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                    </p>
                    <div class="download">
                        <h4>متوفر على</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('front/assets/imgs/google.png')}}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('front/assets/imgs/ios.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{asset('front/assets/imgs/App.png')}}">
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')

<script>
    function toggleFavourite(heart){
    // Toggle between filled and empty heart
  

    $(document).ready(function(){
        var post_id = heart.id;
       $.ajax({
            url: "{{route('client.toggleFavourite')}}",
            type:'POST',
            headers:{'X-CSRF-TOKEN':'{{csrf_token()}}'},
            data: {post_id:post_id },
            success:function(data){
                console.log(data.data);
                if(data.status == 1){
                    $(heart).toggleClass('fas');
                    // refresh page
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorMessage){
                       alert(errorMessage);

                    }
        })
    });

}

</script>
@endpush