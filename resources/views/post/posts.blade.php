@extends('layouts.app')
@section('content')
    <div class="w3l-homeblock2 w3l-homeblock5 py-3">
        <div class="container pt-md-4 pb-md-5">
            <div class="topic-container align-items-center left-right mb-3">
               <div>
                   <h3 class="category-title mb-2">
                     {{ $topic->name }}
                   </h3>
                   <span class="label-blue mb-2">
                     {{ $topic->category->name }}
                   </span>
               </div>
                <div class="img-circle float-right">
                    <div class="author align-items-center">
                        @if($topic->user->avatar)
                            <img src="{{ Storage::url($topic->user->avatar) }}"
                                 class="img-fluid rounded-circle"
                                 alt="Avatar" >
                        @else
                            <img src="{{ asset('assets/images/avatar.png') }}"
                                 class="img-fluid rounded-circle"
                                 alt="Avatar">
                        @endif
                        <ul class="blog-meta mt-1">
                            <li>
                                <p> Creator:
                                    <a href="{{ route('profile', ['user' => $topic->user->id]) }}">
                                        {{ $topic->user->name }}
                                    </a>
                                </p>
                            </li>
                            <li class="meta-item blog-lesson">
                                <p>Created at
                                    <strong>{{ $topic->created_at->format('F j, Y') }}</strong>.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($posts as $post)
                    <div class="col-lg-6 mt-4">
                        <div class="bg-clr-white hover-box">
                            <div class="row">
                                <div class="col-sm-6 position-relative">
                                    <a href="{{ route( 'post.show', ['post' => $post->id]) }}" class="image-mobile">
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

                                <div class="col-sm-6 card-body blog-details align-self">
                                    @auth
                                    @can('editPost', $post)
                                        <span class="label-blue mb-3">
                                            <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="label-blue">
                                               Edit <span class="fa fa-edit"></span>
                                            </a>
                                        </span>
                                    @endcan
                                    @can('deletePost', $post)
                                        <span class="label-blue mb-3">
                                            <a href="{{ route('post.delete', ['post' => $post->id]) }}" class="label-blue">
                                               Delete <span class="fa fa-trash"></span>
                                            </a>
                                        </span>
                                        @endcan
                                    @endauth

                                    <div class="ml-2">
                                        <a href="{{ route('post.show', ['post' => $post->id]) }}" class="blog-desc">
                                            {{ $post->title }}
                                        </a>
                                    </div>

                                    <div class="author align-items-center">
                                        @if($post->user->avatar)
                                            <img src="{{ Storage::url($post->user->avatar) }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar" >
                                        @else
                                            <img src="{{ asset('assets/images/avatar.png') }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar">
                                        @endif
                                        <ul class="blog-meta">
                                            <li>
                                                <a href="{{ route('profile', ['user' => $post->user->id]) }}">
                                                    {{ $post->user->name }}
                                                </a>
                                            </li>
                                            <li class="meta-item blog-lesson">
                                                <span class="meta-value">{{ $post->created_at->format('d.m.Y') }}</span>.
                                                <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container py-lg-5 py-md-4">
                        <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
                            <div class="py-5">
                                <h3 class="section-title-left mb-2">No posts in this topic?</h3>
                                <p class="mb-md-5 mb-4">Start creating now! </p>

                                @auth
                                    <a class="btn btn-style btn-primary"
                                       href="{{ route('post.create', ['step' => 'third', 'selected' => $topic->id]) }}">
                                        Let's go!
                                    </a>
                                @endauth

                                @guest
                                    <a class="btn btn-style btn-primary" href="{{ route('login') }}">
                                        Let's go!
                                    </a>
                                @endguest

                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($posts->hasPages())
                <ul class="site-pagination text-center mt-md-5 mt-4">
                    @for($i = 1; $i <= $posts->lastPage(); $i++)
                        @if($i === $posts->currentPage())
                            <li><span class="page-numbers current">{{ $i }}</span></li>
                        @else
                            <li><a class="page-numbers" href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if($posts->hasMorePages())
                        <li><a class="next page-numbers" href="{{ $posts->nextPageUrl() }}">Next »</a></li>
                    @endif
                </ul>
            @endif

            @if (count($posts) > 0)
                <div class=" py-lg-5 py-md-4">
                    <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
                        <div class="py-5">
                            <h3 class="section-title-left mb-2">Want add new post?</h3>
                            <p class="mb-md-5 mb-4">Start creating now!</p>
                            @auth
                                <a class="btn btn-style btn-primary"
                                   href="{{ route('post.create', ['step' => 'third', 'selected' => $topic->id]) }}">
                                    Let's go!
                                </a>
                            @endauth
                            @guest
                                <a class="btn btn-style btn-primary" href="{{ route('login') }}">Let's go!</a>
                            @endguest
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection('content')

