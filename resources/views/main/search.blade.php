@extends('layouts.app')

@section('content')

    <div class="w3l-homeblock2 w3l-homeblock5 py-1">
        <div class="container py-lg-3 ">

            <div class="left-right">
                <div><h3 class="title mb-2">Search results </h3></div>
                <div>
                    <p class="message mr-2">
                    <span class="fa fa-search">
                        <strong> {{ $query }}</strong>
                    </span>
                    </p>
                </div>
            </div>

            @if($topics->isEmpty() && $posts->isEmpty() && $users->isEmpty())
                <p class="message">No results.</p>
                <span class="fa fa-coffee">
                <strong> Nothing was found for the request "{{ $query }}"</strong>
            </span>
            @else
                <div class="row">
                    @if(!$topics->isEmpty())
                        <span class="label-blue mb-2">
                           Topics
                        </span>

                        @foreach ($topics as $topic)
                            <div class="col-12 mt-4">
                                <div class="bg-clr-white hover-box">
                                    <div class="row">
                                        <div class="col-sm-12 card-body align-self ml-4">
                                            <a href="{{ route('posts', $topic->id) }}">
                                                {{ $topic->name }}
                                            </a>
                                            <p class="">
                                               Author: {{ $topic->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination ml-3 mt-md-4 justify-content-center">
                            {{ $topics->appends(['query' => $query])->links() }}
                        </div>
                    @else
                        <div class="col-12 mt-4">
                            <p class="message">Aren't any topics like "{{$query}}"</p>
                        </div>
                    @endif
                </div>

                <div class="row">
                    @if(!$posts->isEmpty())
                        <span class="label-blue ml-2 mt-4 mb-2">
                          Posts
                        </span>

                        @foreach ($posts as $post)
                            <div class="col-12 mt-4">
                                <div class="bg-clr-white hover-box">
                                    <div class="row">
                                        <div class="col-sm-12 card-body align-self ml-4">
                                            <a href="{{ route('post.show', $post->id) }}">
                                                {{ $post->title }}
                                            </a>
                                            <p class="message">
                                                Author: {{ $post->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination ml-3 mt-md-4 justify-content-center">
                            {{ $posts->appends(['query' => $query])->links() }}
                        </div>
                    @else
                        <div class="col-12 mt-4">
                            <p class="message">Aren't any posts like "{{$query}}"</p>
                        </div>
                    @endif
                </div>

                <div class="row">
                    @if(!$users->isEmpty())
                        <span class="label-blue ml-2 mb-2 mt-4">
                           Profiles
                        </span>

                        @foreach ($users as $user)
                            <div class="col-12 mt-4">
                                <div class="bg-clr-white hover-box">
                                    <div class="row">
                                        <div class="col-sm-12 card-body align-self ml-4">
                                            <a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination ml-3 mt-md-4 justify-content-center">
                            {{ $users->appends(['query' => $query])->links() }}
                        </div>
                    @else
                        <div>
                            <div class="col-12 mt-4">
                                <p class="message">Aren't any profiles like "{{$query}}"</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

@endsection('content')





