@extends('layouts.app')
@section('content')
    <section class="w3l-testimonials" id="testimonials">
        <div class="container pb-lg-5 pt-2 pb-5 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 message-info align-self justify-content-between">
                            <p>  Topic:
                                <span class="meta-value">
                                    <strong>
                                        <a href="{{ route('posts', ['topic' => $topic->id]) }}">{{ $topic->name }}</a>
                                    </strong>
                                </span>
                            </p>

                            <p>  Category:
                                <span class="meta-value">
                                    <strong>
                                        <a href="{{ route('topics', ['category' => $topic->category->slug]) }}">
                                            {{ $topic->category->name }}
                                        </a>
                                    </strong>
                                </span>
                            </p>

                            <p> Posts in the topic:
                                <span class="meta-value">
                                    <strong>
                                        <a href="{{ route('posts', ['topic' => $topic->id]) }}">{{ $countPosts }}</a>
                                    </strong>
                                </span>
                            </p>

                            <p>  Creator:
                                <span class="meta-value">
                                    <strong>
                                        <a href="{{ route('profile', ['user' => $topic->user->id]) }}">
                                            {{ $topic->user->name }}
                                        </a>
                                    </strong>
                                </span>
                            </p>

                            <p> Date of creation: <span class="meta-value">
                                    <strong> {{ $topic->created_at->format('F j, Y') }}</strong>
                                </span>.
                            </p>

                        </div>
                        <div class="img-circle  mt-4">
                            <div class="author align-items-center">
                                @if($topic->user->avatar)
                                    <img src="{{ Storage::url($topic->user->avatar) }}"
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
                                        <a href="{{ route('profile', ['user' => $topic->user->id]) }}">
                                            {{ $topic->user->name }}
                                        </a>
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ $topic->created_at->format('F j, Y') }} </span>.
                                        <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-4 left-right bg-clr-white p-3">
                            <h3 class="section-title-left align-self pl-2  mb-3 ">
                                Are you sure you want to delete the topic?
                            </h3>
                            <form action="{{ route('topic.destroy', ['topic' => $topic->id ]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-style btn-primary" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection