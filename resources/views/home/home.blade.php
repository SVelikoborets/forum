@extends('layouts.app')

@section('content')

    <div class="w3l-testimonials" id="testimonials">
        <div class="container pb-lg-2 pt-2 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="item">
                    <div class="container">
                        <div class="row justify-content-center">
                            @if (session('status'))
                            <div class="col-md-8">
                                <div class="card bg-transparent ">
                                    <div class="card-body ">
                                        <p class="text-center">{{ session('status') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col text-center">
                            <div class="author">
                                @if(Auth::user()->avatar)
                                    <div class="col-sm-12 position-relative">
                                        <div class="img-circle mt-4 mb-4">
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                                 class="img-fluid rounded-circle mx-auto d-block"
                                                 alt="Avatar"
                                                 id="image-preview"
                                                 style="max-width: 150px;">
                                        </div>
                                    </div>
                                @else
                                    <div class="img-circle mt-4 mb-4">
                                        <img src="{{ asset('assets/images/avatar.png') }}"
                                             class="img-fluid rounded-circle mx-auto d-block"
                                             alt="Avatar"
                                             id="image-preview"
                                             style="max-width:150px">
                                    </div>
                                @endif

                                <ul class="text-center mt-1">
                                    <li>
                                        <h2 class="section-title-left ">
                                            <a href="{{ route('profile', ['user'=> Auth::user()->id]) }}" >
                                                {{Auth::user()->name}}
                                            </a>
                                        </h2>
                                    </li>
                                    <li >
                                        <span> July 13, 2020 </span>.
                                        <span class=" ml-2"><span class="fa fa-clock-o"></span> Online</span>
                                        <h5 class="text-center">Welcome to Forum! Reed, write, comment, repeat!</h5>
                                    </li>
                                </ul>
                                <form action="{{ route('profile.avatar') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-center d-flex mt-3">
                                        <div class="blog-details file-upload mr-3">
                                            <label for="image" class="file-upload-label btn btn-style btn-secondary text-white">
                                                Choose Avatar
                                            </label>
                                            <input type="file" name="image" id="image" style="display: none">
                                        </div>
                                        <div class="blog-details">
                                            <button id="submit-button" type="button"
                                                    class="btn btn-style btn-primary text-white">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <x-homeblock :topics="$topics" :posts="$posts" :top="$top"/>

    <div class="w3l-homeblock2 w3l-homeblock6 py-2">
        <div class="container px-sm-5 py-lg-5 py-md-4">
            <h1 class="section-title-left  mb-5 text-center">My posts</h1>
            <div class="row">

                @forelse($posts as $post)
                    <div class="col-lg-6 mt-4">
                        <div class="bg-clr-white hover-box">
                            <div class="row">
                                <div class="col-sm-6 position-relative">
                                    <a href="{{ route('post.show', ['post'=>$post->id]) }}" class="image-mobile">
                                        <div style="width: 100%; padding-bottom: 100%; position: relative; overflow: hidden;">
                                            @if($post->image)
                                                <img class="card-img-bottom d-block radius-image-full"
                                                     src="{{ Storage::url($post->image) }}"
                                                     alt="Card image cap"
                                                     id="image-preview"
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

                                   <span class="label-blue  mb-1">
                                        <a href="{{ route('topics', ['category' => $post->category->slug]) }}">
                                            {{ $post->category->name }}
                                        </a>
                                   </span>
                                   <span class="label-blue  ">
                                        <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                            {{ $post->topic->name }}
                                        </a>
                                   </span>

                                    <div class="ml-2">
                                        <a href="{{ route('post.show', ['post' => $post->id])}}" class="blog-desc mt-1 mb-1">
                                            {{ $post->title }}
                                        </a>
                                    </div>

                                    <span class="label-blue">
                                        <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="label-blue">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </span>

                                    <span class="label-blue">
                                        <a href="{{ route('post.delete', ['post' => $post->id]) }}" class="label-blue">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="container py-lg-5 py-md-4">
                        <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
                            <div class="py-5">
                                <h3 class="section-title-left mb-2">No posts yet?</h3>
                                <p class="mb-md-5 mb-4">Start creating now! </p>
                                <a class="btn btn-style btn-primary" href="{{ route('post.create', ['step' => 'first']) }}">
                                    Let's go!
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($posts->hasPages())
                <ul class="site-pagination text-center mt-md-5 mt-4">
                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                        @if ($i === $posts->currentPage())
                            <li><span class="page-numbers current">{{$i}}</span></li>
                        @else
                            <li>
                                <a class="page-numbers"
                                   href="{{ $posts->appends(['topic_page' => $topics->currentPage()])->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endfor
                    @if ($posts->hasMorePages())
                        <li>
                            <a class="next page-numbers"
                               href="{{ $posts->appends(['topic_page' => $topics->currentPage()])->nextPageUrl() }}">
                                Next »
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="container py-lg-5 py-md-4">
                    <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
                        <div class="py-5">
                            <h3 class="section-title-left mb-2">Want add new post?</h3>
                            <p class="mb-md-5 mb-4">Start creating now! </p>
                            <a class="btn btn-style btn-primary" href="{{ route('post.create', ['step' => 'first']) }}">Let's go!</a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-4 left-right bg-clr-white p-3">
                <h3 class="section-title-left align-self pl-2  mb-3 ">Want delete this profile? </h3>
                <a class="btn btn-style btn-primary"
                   href="{{ route('profile.delete', ['profile' => Auth::user()->id]) }}">
                    Delete
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('image').addEventListener('change', function() {
            const label = document.querySelector('.file-upload-label');
            const fileName = this.files.length ? this.files[0].name : 'Choose Avatar';
            label.textContent = fileName;
            previewImage(this);
            const submitButton = document.getElementById('submit-button');
            submitButton.setAttribute('type', 'submit');
            submitButton.textContent = 'Upload and Save';
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
