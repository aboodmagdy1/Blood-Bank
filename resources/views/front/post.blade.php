@inject('Post', 'App\Models\Post')
@extends('front.layouts.master')
@section('title', 'Post' . $post->id)

@section('content')
    <!--inside-article-->
    <div class="article-details">
        <div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/posts">المقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="article-image">
                    <img src="{{ asset('front/assets/imgs/p1.jpg') }}">
                </div>
                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4>{{ $post->title }}</h4>
                    </div>
                    <div class="icon col-6">
                        @auth('web-client')
                            <button href="#" class="favourite">
                                <i id="{{ $post->id }}" class="far fa-heart {{ $post->is_favourite ? 'fas' : '' }}"
                                    onclick="toggleFavourite(this)"></i>
                            </button>
                        @endauth
                    </div>
                </div>

                <!--text-->
                <div class="text">
                    <p>
                        {{ $post->content }}
                    </p> <br>
                    <p>
                        {{ $post->content }}
                    </p>
                </div>

                <!--articles-->
                <div class="articles">
                    <div class="title">
                        <div class="head-text">
                            <h2>مقالات ذات صلة</h2>
                        </div>
                    </div>
                    <div class="view">
                        <div class="row">
                            <!-- Set up your HTML -->
                            <div class="owl-carousel articles-carousel">
                                @foreach ($Post->all() as $post)
                                    <div class="card">
                                        <div class="photo">
                                            <img src="{{ asset('front/assets/imgs/p2.jpg') }}" class="card-img-top"
                                                alt="...">
                                            <a href="{{ url('posts/' . $post->id) }}" class="click">المزيد</a>
                                        </div>
                                        @auth('web-client')
                                            <button href="#" class="favourite">
                                                <i id="{{ $post->id }}"
                                                    class="far fa-heart {{ $post->is_favourite ? 'fas' : '' }}"
                                                    onclick="toggleFavourite(this)"></i>
                                            </button>
                                        @endauth

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <p class="card-text">
                                                {{ $post->content }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        function toggleFavourite(heart) {
            // Toggle between filled and empty heart


            $(document).ready(function() {
                var post_id = heart.id;
                $.ajax({
                    url: "{{ route('client.toggleFavourite') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        post_id: post_id
                    },
                    success: function(data) {
                        console.log(data.data);
                        if (data.status == 1) {
                            $(heart).toggleClass('fas');
                            // refresh page
                            location.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorMessage) {
                        alert(errorMessage);

                    }
                })
            });

        }
    </script>
@endpush
