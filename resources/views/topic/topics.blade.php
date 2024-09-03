@extends('layouts.app')
@section('content')
    <div class="w3l-homeblock2 py-3">
        <div class="container  py-md-4">
            <div class="col-lg-8 ">
                <h3 class="section-title-left align-self  "> Topics  • {{ $category->name }}</h3>
                <p>Choose or create a topic and start sharing your experiences and impressions!</p>
            </div>
            <div class="row mt-3">
                @foreach($topics->chunk(4) as $chunk)
                    <div class="col-lg-4 trending mt-lg-0 ">
                        <div class="topics">
                            @foreach($chunk as $topic)
                            <a href="{{ route('posts', ['topic' => $topic->id]) }}" class="topics-list mt-3">
                                <div class="list1">
                                    <span class="fa {{ $category->icon }}"></span>
                                    <h4>{{$topic->name}}</h4>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if($topics->hasPages())
                <ul class="site-pagination text-center mt-md-5 mt-4">
                    @for ($i = 1; $i <= $topics->lastPage(); $i++)
                        <li>
                            @if ($i === $topics->currentPage())
                                <span class="page-numbers current">{{ $i }}</span>
                            @else
                                <a class="page-numbers" href="{{ $topics->url($i) }}">{{ $i }}</a>
                            @endif
                        </li>
                    @endfor
                    @if ($topics->hasMorePages())
                        <li><a class="next page-numbers" href="{{ $topics->nextPageUrl() }}">Next »</a></li>
                    @endif
                </ul>
            @endif

            <div class="mt-4 left-right bg-clr-white p-3">

                @auth
                <h3 class="section-title-left align-self pl-2  mb-3 ">You can start new topic </h3>
                <a class="btn btn-style btn-primary"
                   href="{{ route('topic.create', ['category'=>$category->slug]) }}">Let's go!</a>
                @endauth

                @guest
                    <h3 class="section-title-left align-content-center pl-2 mb-3 ">
                        - <a href="{{ route('register') }}"> Register</a>
                        or
                        <a href="{{ route('login') }}">login</a>
                        to add new topics -
                    </h3>
                @endguest

            </div>
        </div>
    </div>
@endsection('content')
