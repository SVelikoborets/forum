@extends('layouts.app')
@section('title','Response')
@section('content')
    <div class="container mb-4">
        <div class=" col-12 mt-4 form-inner-cont">
            <div class="bg-clr-white hover-box">
                <div class="col-sm-12 card-body blog-details align-self ml-2">

                    <form action="{{ route('add.comment', ['postId' => $postId]) }}" method="post" >
                        @csrf
                        <div class="form-input">
                            <a class="" href="{{ route('profile', ['user' => $user->id]) }}">
                                {{ $user->name }},
                            </a>

                            <textarea name="comment" id="w3lMessage" placeholder="Add your comment here"
                                      class="@error('comment') is-invalid @enderror"></textarea>

                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input  value ="{{ Auth::user()->id }}" name ="author_id" type="hidden">
                            <input  value ="{{ $user->id }}" name ="response_id" type="hidden">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-style btn-primary">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

