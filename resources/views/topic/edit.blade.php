@extends('layouts.app')
@section('content')

    <div class="w3l-contact-10 py-5" id="contact">
        <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
            <div class="container">
                <div class="heading">
                    <h3 class="category-title mb-3">Update your topic </h3>
                    <p class="mb-md-5 mb-4">
                        If you have a question regarding our services, feel free to contact us using the form below.
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-8 form-inner-cont">

                        <form action="{{ route('topic.update', ['topic' => $topic->id]) }}" method="post" class="signin-form">
                            @csrf
                            @method('PATCH')
                            <div class="container ">
                                <label  for="category" class=" col-form-label ">Choose category:</label>
                                <select name="category" id="category" class="custom-select @error('category') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        @if($category->slug==$topic->category->slug)
                                            <option value="{{ $category->id }}" selected>
                                                <i class="fa {{ $category->icon }}"></i> {{ $category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">
                                                <i class="fa {{ $category->icon }}"></i> {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <textarea id="w3lMessage" class="@error('name') is-invalid @enderror" name="name"
                                          placeholder="Write topic's title here "
                                          required="">{{ old('name', $topic->name) }}</textarea>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="text-right">
                                    <button class="btn btn-style btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 left-right bg-clr-white p-3">
                    <h3 class="section-title-left align-self pl-2  mb-3 ">Delete this topic? </h3>
                    <a class="btn btn-style btn-primary"
                       href="{{ route('topic.delete', ['topic' => $topic->id]) }}">
                        <span class="fa fa-trash-o"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
