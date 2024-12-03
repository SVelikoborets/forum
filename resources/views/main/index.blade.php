@extends('layouts.app')
@section('title','2BForum')
@section('content')
    <section class="w3l-homeblock1 py-sm-5 py-4">
        <div class="container py-md-4">
            <div class="grids-area-hny main-cont-wthree-fea row">
                @foreach($categories as $category)
                <div class="col-lg-3 col-6 grids-feature mb-4">
                    <a href="{{route( 'topics', [ 'category' => $category->slug] )}}">
                        <div class="area-box">
                            <span class="fa {{ $category->icon }}"></span>
                            <h4 class="title-head">{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
                 @endforeach
                <div class="col-12 grids-feature mb-4">
                    <div class="area-box">
                        @guest
                            <a href="{{route('register')}}">
                                <span class="fa fa-users"></span>
                                <h4 class="title-head">
                                    Join the Best Beauty-Forum to discuss the latest trends in beauty!
                                </h4>
                            </a>
                            @else
                            <a href="{{route('home')}}">
                                <span class="fa fa-star"></span>
                                <h4 class="title-head">
                                    Join the Best Beauty-Forum to discuss the latest trends in beauty!
                                </h4>
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($top))
        <x-top :top="$top"/>
    @endif

    <div class="container py-md-4 my-4">
        <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2 mb-2">
            <div class="py-5 ">
                <h3 class="section-title-left align-self pl-2  mb-3 "> Start your topic! </h3>

                @auth
                    <a class="btn btn-style btn-primary" href="{{ route('topic.create') }}">Let's go!</a>
                @endauth

                @guest
                    <a class="btn btn-style btn-primary" href="{{ route('login') }}">Let's go!</a>
                @endguest

            </div>

            <div class="py-5">
                <h3 class="section-title-left mb-2">Or add your post!</h3>
                <p class="mb-md-5 mb-4">Start creating now! </p>

                @auth
                    <a class="btn btn-style btn-primary" href="{{ route( 'post.create', ['step' => 'first']) }}">
                        Let's go!
                    </a>
                @endauth

                @guest
                    <a class="btn btn-style btn-primary" href="{{ route('login') }}">Let's go!</a>
                @endguest

            </div>
        </div>
    </div>

    @foreach($categories as $category)
        <x-posts :category="$category"/>
    @endforeach

@endsection('content')
