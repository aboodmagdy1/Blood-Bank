@extends('front.layouts.master')
@section('title','المقالات')


@section('content')
    <div class="articles py-5" id="articles-section">
        <div class="container text-center mb-5">
            <h2 class="head-text font-weight-bold">المقالات</h2>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    @foreach ($posts->all() as $post)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="photo position-relative">
                                <img src="{{asset('front/assets/imgs/p2.jpg')}}" class="card-img-top" alt="Article Image">
                            </div>
                            @auth('web-client')
                            <a href="#" class="favourite position-absolute top-0 end-0 m-3">
                                <i id="{{$post->id}}" class="text-danger far fa-heart {{$post->is_favourite ? 'fas' : ''}}" onclick="toggleFavourite(this)"></i>
                            </a>
                            @endauth
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title font-weight-bold">{{$post->title}}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($post->content, 100) }}</p>
                                <a href="{{url('posts/'.$post->id)}}" class="btn btn-outline-primary mt-3">اقرأ المزيد</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
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