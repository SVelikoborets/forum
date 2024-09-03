@extends('layouts.app')
@section('content')
    <div class="w3l-contact-10 py-5" id="contact">
        <div class="container">
            <div class="heading">
                <h3 class="category-title mb-3">Edite your post </h3>
                <p class="mb-md-5 mb-4">If you have a question regarding our services, feel free
                    to contact us using help.</p>
            </div>

            <div class="col-md-12" id="contact">
                <form action="{{ route('post.update', ['post' => $post->id]) }}"
                      method="post"
                      class="signin-form "
                      style="max-width:100%"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-inner-cont">

                                <label for="category" class="col-form-label">
                                    Choose category:
                                </label>

                                <select name="category" id="category" class="custom-select @error('category') is-invalid @enderror" onchange="loadTopics(this.value)">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="topic" class="col-form-label mt-3">
                                    Choose topic:
                                </label>

                                <select name="topic" id="topic" class="custom-select @error('topic') is-invalid @enderror">
                                    <option value="">Select Topic</option>
                                    @foreach($post->category->topics as $topic)
                                        <option value="{{$topic->id}}" {{ $post->topic_id == $topic->id ? 'selected' : '' }}>
                                            {{$topic->name}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @error('topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="form">
                                    <label for="w3lName" class="col-form-label mt-3">
                                        Edit title:
                                    </label>
                                    <div class="form-input ">
                                        <input type="text" name="title"
                                               class="@error('title') is-invalid @enderror"
                                               value="{{ old('title', $post->title) }}" required id="w3lName"
                                               placeholder="Enter post's title *">

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <label for="w3lMessage" class="col-form-label mt-3">
                                    Edit text:
                                </label>

                                <div class="form-input">
                                    <textarea name="content"
                                          class="@error('content') is-invalid @enderror"
                                          id="w3lMessage"
                                          placeholder="Enter post's text" >{{ old('content', $post->content) }}
                                    </textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contacts-5-grid">
                                <div class="map-content-5 ">
                                    @if($post->image)
                                        <div class="col-sm-12 position-relative">
                                            <img class="card-img-bottom d-block radius-image-full"
                                                 src="{{ Storage::url($post->image) }}"
                                                 alt="Card image cap"
                                                 id="image-preview">
                                        </div>
                                    @else
                                        <div class="col-sm-12 position-relative">
                                            <img class="card-img-bottom d-block radius-image-full"
                                                 src="{{ asset('assets/images/empty.jpg') }}"
                                                 alt="Card image cap"
                                                 id="image-preview">
                                        </div>
                                    @endif
                                    <div class="card-body blog-details align-self file-upload">

                                        <label for="image" class="file-upload-label pl-lg-3">
                                            Download image
                                        </label>
                                        <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type ="submit" class="btn btn-style btn-primary text-white">Save</button>
                    </div>
                </form>
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
            previewImage(this);
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

