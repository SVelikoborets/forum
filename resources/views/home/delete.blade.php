@extends('layouts.app')
@section('content')
    <section class="w3l-testimonials" id="testimonials">
        <div class="container pb-lg-5 pt-2 pb-5 mt-4">
            <div class="mb-md-0 mb-sm-5 mb-4">
                <div class="item ">
                    <div class="row ">
                        <div class="col-lg-8 message-info align-self justify-content-between">

                            <h3 class="title-big mb-4">{{ $user->name }}</h3>
                            <p class="message">{{ $user->email }}</p>
                            <p> Register at
                                <span class="meta-value">
                                    <strong> {{ $user->created_at->format('F j, Y') }}</strong>
                                </span>.
                            </p>
                        </div>
                        <div class="img-circle  mt-4">
                            <div class="author align-items-center">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}"
                                         class="img-fluid rounded-circle" alt="Avatar" style="max-width: 250px;" >
                                @else
                                    <img src="{{ asset('assets/images/avatar.png') }}"
                                         class="img-fluid rounded-circle" alt="Avatar" style="max-width: 250px;">
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 left-right bg-clr-white p-3">
                            <h3 class="section-title-left align-self pl-2  mb-3 ">
                                Are you sure you want to delete profile?
                            </h3>
                            <form action="{{ route('profile.destroy', ['profile' => $user->id ]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-style btn-primary"
                                       value="Delete" onclick="return confirm('Are you sure?')">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection