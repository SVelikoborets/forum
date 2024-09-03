@extends('layouts.app')

@section('content')
    <div class="overlay" id="overlay"></div>
    <div class="modal-form " id="deleteModal">
        <div class="mt-4 left-right bg-clr-white p-3">
            <h3 class="section-title-left align-self pl-2 mb-3">
                Delete it?
            </h3>
            <form action="{{ route('post.destroy', ['post' => $post->id ]) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-style btn-primary" value="Yes">
                <a href="{{ url()->previous() }}" class="btn btn-style btn-primary">No</a>
            </form>
        </div>
    </div>

    <section class="w3l-testimonials" id="testimonials">
        <div class="container pb-lg-5 pt-2 pb-5 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="item ">
                    <div class="row ">
                        <div class="col-lg-8 message-info align-self justify-content-between">
                             <span class="label-blue mb-4">
                                <a href="{{ route('topics', ['category' => $post->category->slug]) }}">
                                    {{ $post->category->name }}
                                </a>
                            </span>
                            <span class="label-blue mb-4">
                                <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                    {{$post->topic->name}}
                                </a>
                            </span>
                            <h3 class="title-big mb-4">{{$post->title}}</h3>
                            <p class="message">{{$post->content}}</p>
                            <p>
                                <span class="meta-value">
                                    <strong>{{ $post->created_at->format('F j, Y') }}</strong>
                                </span>.
                            </p>
                        </div>

                        <div class="img-circle  mt-4">
                            <div class="author align-items-center">
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
                                        <span class="meta-value"> {{ $post->created_at->format('F j, Y') }} </span>.
                                        <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4 mb-2">
            <x-comment :post="$post->id"/>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('overlay').style.display = 'block';
            document.getElementById('deleteModal').style.display = 'block';
        });
    </script>
@endsection
