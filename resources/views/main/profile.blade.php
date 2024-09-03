@extends('layouts.app')
@section('content')

    <div class="w3l-testimonials" id="testimonials">
        <div class="container pb-lg-5 pt-2 pb-5 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="item">
                    <div class="container">
                        <div class="col text-center">
                            <div class="author">
                                @if($user->avatar)
                                    <div class="col-sm-12 position-relative">
                                        <div class="img-circle mt-4 mb-4">
                                            <img src="{{ Storage::url($user->avatar) }}"
                                                 class="img-fluid rounded-circle mx-auto d-block"
                                                 alt="Avatar"
                                                 style="max-width:150px">
                                        </div>
                                    </div>
                                @else
                                    <div class="img-circle mt-4 mb-4">
                                        <img src="{{ asset('assets/images/avatar.png') }}"
                                             class="img-fluid rounded-circle mx-auto d-block"
                                             alt="Avatar"
                                             style="max-width:150px">
                                    </div>
                                @endif
                                <ul class="text-center mt-1">
                                    <li>
                                        <h2 class="section-title-left ">{{$user->name}}</h2>
                                    </li>
                                    <li>
                                        <span class=""> July 13, 2020 </span>.
                                        <span class=" ml-2"><span class="fa fa-clock-o"></span> Online</span>
                                        @if(count($topicsList)>0)
                                            <h5 class="text-center">Creator of topics</h5>
                                            @foreach($topicsList as $topic)
                                                <strong> •
                                                    <a class="text-center" href="{{ route('posts', ['topic' =>  $topic->id]) }}">
                                                        {{ $topic->name }}
                                                    </a>
                                                </strong>
                                            @endforeach
                                        @else
                                            <h5 class="text-center">Creator</h5>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w3l-homeblock2 w3l-homeblock6 py-2">
            <div class="container px-sm-5 py-lg-5 py-md-4">
                <h1 class="section-title-left  mb-5 text-center">Posts</h1>
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-lg-6 mt-4">
                            <div class="bg-clr-white hover-box">
                                <div class="row">
                                    <div class="col-sm-5 position-relative">
                                        <a href="{{ route( 'post.show', ['post' => $post->id] ) }}" class="image-mobile">
                                            <div style="width: 100%; padding-bottom: 100%; position: relative; overflow: hidden;">
                                                @if($post->image)
                                                    <img class="card-img-bottom d-block radius-image-full"
                                                         src="{{ Storage::url($post->image) }}"
                                                         alt="Card image cap"
                                                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <img class="card-img-bottom d-block radius-image-full"
                                                         src="{{ asset('assets/images/empty.png') }}"
                                                         alt="Card image cap"
                                                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-7 card-body blog-details align-self">
                                        <div >
                                            <span class="label-blue mb-1">
                                                <a href="{{ route('topics', ['category' => $post->category->slug]) }}">
                                                    {{ $post->category->name }}
                                                </a>
                                           </span>
                                            <span class="label-blue">
                                                <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                                    {{ $post->topic->name }}
                                                </a>
                                           </span>
                                        </div>
                                        <a href="{{ route('post.show', ['post' => $post->id]) }}" class="blog-desc ml-2 ">
                                            {{$post->title}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="container">
                            <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
                                <div class="py-5">
                                    <span class="label-blue">No posts yet...</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($posts->hasPages())
                    <ul class="site-pagination text-center mt-4 mb-4">
                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            @if ($i === $posts->currentPage())
                                <li><span class="page-numbers current">{{$i}}</span></li>
                            @else
                                <li><a class="page-numbers" href="{{ $posts->url($i) }}">{{$i}}</a></li>
                            @endif
                        @endfor
                        @if ($posts->hasMorePages())
                            <li><a class="next page-numbers" href="{{ $posts->nextPageUrl() }}">Next »</a></li>
                        @endif
                    </ul>
                @endif

                @auth
                    @if($user->writeInTopicBy(Auth::user()))
                        <form action="{{ route('block', ['user' => $user->id]) }}" method="post" >
                            @csrf
                            @method('PATCH')
                            <div class=" text-center bg-clr-white mt-4 py-md-5 py-2">
                                <div class="py-5">
                                    <h3 class="section-title-left mb-2">Bad activity or spam?</h3>
                                    <input type="submit"
                                           class="btn btn-style btn-primary"
                                           value= "Block {{ $user->name }}"
                                           onclick="return confirm('Are you sure?')">
                                </div>
                            </div>
                        </form>
                    @endif
                @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

