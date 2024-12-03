@extends('layouts.app')
@section('title','Create post')
@section('content')
    <div class="w3l-contact-10 py-5" id="contact">
        <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
            <div class="container">
                <div class="heading">
                    <h3 class="category-title mb-3">Create new post </h3>
                    <p class="mb-md-5 mb-4">If you have a question regarding our services, feel free
                        to contact us using help.</p>
                </div>

                @if($step==1)
                    <section class="w3l-homeblock1 py-sm-2 py-4">
                        <div class="container ">
                            <h2 class="section-title-left mb-3">Step 1. Chose the category </h2>
                            <div class="grids-area-hny main-cont-wthree-fea row">
                                @foreach($categories as $category)
                                    <div class="col-lg-3 col-6 grids-feature">
                                        <a href="{{route('post.create', ['step' => 'second', 'selected' => $category->slug]) }}">
                                            <div class="area-box">
                                                <span class="fa {{$category->icon}}"></span>
                                                <h4 class="title-head">{{$category->name}}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                @elseif($step==2)
                    <div class="w3l-homeblock2  ">
                        <div class="">
                            <span class="label-blue  mb-4 ">{{$category->name}}</span>
                            <div class="col-lg-8 ">
                                <h2 class="section-title-left mb-3">Step 2. Chose the topic </h2>
                            </div>
                            <div class="row mt-3">
                                @foreach($topics->chunk(4) as $chunk)
                                    <div class="col-lg-4 trending mt-lg-0 ">
                                        <div class="topics">
                                            @foreach($chunk as $topic)
                                                <a href="{{ route('post.create', ['step' => 'third', 'selected' => $topic->id]) }}"
                                                   class="topics-list mt-3">
                                                    <div class="list1">
                                                        <span class="fa {{$category->icon}}"></span>
                                                        <h4>{{$topic->name}}</h4>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <ul class="site-pagination text-center mt-md-5 mt-4">
                                @for ($i = 1; $i <= $topics->lastPage(); $i++)
                                    @if ($i === $topics->currentPage())
                                        <li><span class="page-numbers current">{{$i}}</span></li>
                                    @else
                                        <li><a class="page-numbers" href="{{$topics->url($i)}}">{{$i}}</a></li>
                                    @endif
                                @endfor
                                @if ($topics->hasMorePages())
                                    <li><a class="next page-numbers" href="{{$topics->nextPageUrl()}}">Next »</a></li>
                                @endif
                            </ul>

                            <div class="mt-4 left-right bg-clr-white p-3">
                                <h3 class="section-title-left align-self pl-2  mb-3 ">You can start new topic </h3>
                                    <a class="btn btn-style btn-primary"
                                       href="{{route('topic.create', ['category' => $category->slug]) }}">
                                        Let's go!
                                    </a>
                            </div>
                        </div>
                    </div>

                @elseif($step==3)
                    <div class="w3l-contact-10 " id="contact">
                        <div class="form-41-mian  pb-md-4">
                            <span class="label-blue  mb-4 ">{{$topic->category->name}}</span>
                            <span class="label-blue  mb-4 ">{{$topic->name}} </span>
                            <div class="col-lg-8 ">
                                <h2 class="section-title-left mb-3">Step 3. Make a post </h2>
                                <p >
                                    If you creating a post in topics of other authors, you are responsible for the content of the post.
                                </p>
                                <p class="mb-md-5 mb-4">
                                    The theme author can remove unwanted content and also block users who post unwanted material.
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 form-inner-cont">
                                    <form action="{{ route('post.store') }}" method="post"
                                          enctype="multipart/form-data" class="signin-form">
                                        @csrf
                                        <div class="form-grids">

                                            <div class="form-input">
                                                <input type="text"
                                                       class="@error('title') is-invalid @enderror" name="title"
                                                       value="{{ old('title') }}" required id="w3lName"
                                                       placeholder="Enter post's title *">

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-input">
                                            <textarea name="content" class="@error('content') is-invalid @enderror" id="w3lMessage" placeholder="Enter post's text" required="">{{ old('content') }}</textarea>

                                            @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name ="category" value="{{$topic->category_id}}">
                                        <input type="hidden" name ="topic" value="{{$topic->id}}">

                                        <div class="file-upload">
                                            <label for="image" class="file-upload-label">Download image</label>
                                            <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="text-right">
                                            <button type ="submit" class="btn btn-style btn-primary text-white">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection('content')

@section('script')
    <script>
        document.getElementById('image').addEventListener('change', function() {
            const label = document.querySelector('.file-upload-label');
            const fileName = this.files.length ? this.files[0].name : 'Download image';
            label.textContent = fileName;
        });
    </script>
@endsection

