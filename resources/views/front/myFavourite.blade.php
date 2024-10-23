@extends('front.layouts.master')
@section('title','My Favourite')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <ul class="list-group shadow-sm">
                @foreach ($posts as $post)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                    <span class="font-weight-bold">{{$post->title}}</span>
                    <button class="btn p-0">
                        <i id="{{$post->id}}" class="far fa-heart {{$post->is_favourite ? 'fas' : ''}} text-danger" 
                           style="font-size: 1.5rem;" onclick="toggleFavourite(this)"></i>
                    </button>
                </li>
                @endforeach
            </ul>
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