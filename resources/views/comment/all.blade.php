@extends('layouts.app')
@section('content')
    <div class="w3l-homeblock2 w3l-homeblock5 py-1">
        <div class="container py-lg-3 ">
            <!-- block -->
            <div class="left-right">
                <h3 class="section-title-left mb-sm-4 mb-2"> Comments</h3>
            </div>
            <div class="row">
                @foreach($comments as $comment)
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
                                                <a href="{{ route('profile', ['user' => $comment->user->id]) }}">{{$comment->user->name}}</a>
                                            </li>
                                            <li class="meta-item blog-lesson">
                                                <span class="meta-value">{{ $comment->created_at->format('d.m.Y') }}</span>.
                                                <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
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
                                        @can('deleteComment', $comment)
                                            <form action="{{ route('comment.destroy', ['comment' => $comment->id ]) }}"
                                                  method="POST" class="float-right mr-3">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-style btn-primary" value="Delete">
                                            </form>
                                        @endcan

                                        @if($comment->user->id!==Auth::user()->id)
                                            <a href="{{ route('response', ['postId' => $postId,'user' => $comment->user->id]) }}">
                                                Reply to {{$comment->user->name}}
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @guest
                    <div class="col-sm-12 text-center align-self mt-4">
                        <h3 class="section-title-left align-content-center pl-2 mb-3 ">
                            - <a href="{{ route('register') }}"> Register</a>
                            or
                            <a href="{{ route('login') }}">login</a>
                            to add comments -
                        </h3>
                    </div>
                @endguest

            </div>
            @auth
                <x-comment :post="$postId"/>
            @endauth
        </div>
    </div>
@endsection('content')
