@extends('layouts.app')
@section('content')
    <div class="w3l-contact-10 py-5" id="contact">
        <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
            <div class="container">
                <div class="heading">
                    <h3 class="category-title mb-3">Create new topic </h3>
                    <p >
                        By creating a topic, you become its moderator and can delete unwanted posts from other users.
                    </p>
                    <p class="mb-md-5 mb-4">
                        You can also block users who leave spam in your topics.
                    </p>
                </div>

                <div class="col-lg-8 form-inner-cont">

                    <form action="{{ route('topic.store') }}" method="post" class="signin-form">
                        @csrf
                        <div class="container ">
                            <label  for="category" class=" col-form-label ">Choose category:</label>
                            <select name="category" id="category"
                                    class="custom-select @error('category') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    @if($category->slug==$selected)
                                        <option value="{{ $category->id }}" selected>
                                            <i class="fa {{ $category->icon }}"></i> {{$category->name}}
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
                                      required="">{{ old('name') }}</textarea>

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
        </div>
    </div>
@endsection('content')
