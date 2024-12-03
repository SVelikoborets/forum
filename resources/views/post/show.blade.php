@extends('layouts.app')
@section('title', $post->title )
@section('content')
    <section class="w3l-testimonials" id="testimonials">

        <div class="container pb-lg-5 pt-2 pb-2 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="item">
                    <div class="row">
                        <div class="col-lg-8 message-info align-self">
                            <span class="label-blue mb-4">
                                <a href="{{ route('topics', ['category' => $post->category->slug]) }}">
                                    {{ $post->category->name }}
                                </a>
                            </span>
                            <span class="label-blue  mb-4 ">
                                <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                    {{$post->topic->name}}
                                </a>
                            </span>
                            @auth
                                @if($post->user_id == Auth::user()->id)
                                    <span class="label-blue">
                                        <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="label-blue">
                                           Edit <span class="fa fa-edit"></span>
                                        </a>
                                    </span>
                                @endif

                                @can('deletePost', $post)
                                    <span class="label-blue">
                                        <a href="{{ route('post.delete', ['post' => $post->id]) }}" class="label-blue">
                                           Delete <span class="fa fa-trash"></span>
                                        </a>
                                    </span>
                                @endcan
                            @endauth

                            <h3 class="title-big mb-4">{{ $post->title }}</h3>
                            <p class="message">{{ $post->content }}</p>
                            <p>
                                <span class="meta-value">
                                    <strong>{{ $post->created_at->format('F j, Y') }}</strong>
                                </span>.
                            </p>
                        </div>

                        <div class="img-circle align-content-sm-center">
                            <div class="author align-items-center  px-4 py-4">
                                @if($post->user->avatar)
                                    <img src="{{ Storage::url($post->user->avatar) }}"
                                         class="img-fluid rounded-circle"
                                         alt="Avatar"
                                         style="max-width: 250px;" >
                                @else
                                    <img src="{{ asset('assets/images/avatar.png') }}"
                                         class="img-fluid rounded-circle"
                                         alt="Avatar"
                                         style="max-width:250px">
                                @endif

                                <ul class="blog-meta text-center mt-1">
                                    <li>
                                        <a href="{{ route('profile', ['user' => $post->user->id]) }}">
                                            {{ $post->user->name }}
                                        </a>
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value">{{ $post->created_at->format('F j, Y') }} </span>
                                    </li>
                                    <li class="meta-item blog-lesson">
                                       <span class="meta-value ml-2"><span class="fa fa-clock-o"></span>
                                           {{ $post->user->isOnline() ? 'Online' : 'Offline' }}
                                       </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="w3l-homeblock2 w3l-homeblock5 py-1">
        <div class="container py-lg-3 ">

            @if(count($post->comments)>0)
                <div class="left-right">
                    <h3 class="section-title-left mb-sm-4 mb-2"> Comments</h3>
                </div>
                <div class="row">

                    @foreach($post->comments->take(3) as $comment)
                    <div class="col-12 mt-4">
                        <div class="bg-clr-white hover-box">
                            <div class="row">
                                <div class="col-sm-12 card-body align-self ml-4">
                                    <div class="author align-items-center mb-2">
                                        @if($comment->user->avatar)
                                            <img src="{{ Storage::url($comment->user->avatar) }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar" >
                                        @else
                                            <img src="{{ asset('assets/images/avatar.png') }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar">
                                        @endif
                                        <ul class="blog-meta">
                                            <li>
                                                <a href="{{ route('profile', ['user' => $comment->user->id]) }}">
                                                    {{$comment->user->name}}
                                                </a>
                                            </li>
                                            <li class="meta-item blog-lesson">
                                                <span class="meta-value">
                                                    {{ $comment->created_at->format('F j, Y') }}</span>. <span
                                                    class="meta-value ml-2"><span class="fa fa-clock-o"></span>
                                                    {{ $comment->user->isOnline() ? 'Online' : 'Offline' }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    @if($comment->response_id)
                                        <a class="" href="{{ route('profile', ['user' => $comment->response_id]) }}">
                                            {{$comment->respondedUser->name}},
                                        </a>
                                    @endif
                                    <p class="message">{{ $comment->comment }}</p>

                                    @auth
                                        <div class="pr-3">

                                            @if($comment->user->id!==Auth::user()->id)
                                                <div>
                                                    <a href="{{ route('response', ['postId' => $post->id,'user' => $comment->user->id]) }}">
                                                        Reply to {{ $comment->user->name }}
                                                    </a>
                                                </div>
                                            @endif

                                            @can('deleteComment', $comment)
                                                <div>
                                                    <form action="{{ route('comment.destroy', ['comment' => $comment->id ]) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-style btn-primary float-right" value="Delete">
                                                    </form>
                                                </div>
                                            @endcan
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif

            @if(count($post->comments)>3)
                <div class="button ml-4 mt-4">
                    <a href="{{route('post.comments', ['post' => $post->id]) }}"
                       class="more btn btn-small mb-sm-0 mb-4">View more</a>
                </div>
            @endif

            @auth
                <x-comment :post="$post->id"/>
            @endauth

            @guest
                <div class="col-sm-12 align-self mt-4">
                    <h3 class="section-title-left align-content-lg-center pl-2 mb-3 ">
                        - <a href="{{ route( 'register' ) }}"> Register</a>
                        or
                        <a href="{{ route( 'login' ) }}">login</a>
                        to add comments -
                    </h3>
                </div>
            @endguest
        </div>
    </div>

@endsection('content')