@extends('layouts.loginMaster',['title' => 'Login'])

@section('content')

<div class="auth-layout-wrap" style="background-image: url(./assets/images/restaurant.jpg)">
        <div class="auth-content">
            <div class="card o-hidden"  >
              <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img src="assets/images/reservation.png" alt="">
                            </div>
                            <h1 class="mb-3 text-24 text-center">{{config('app.name')}}</h1>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">@lang('contents.user_id')</label>
                                    <input id="user_id" type="text" class="form-control form-control-rounded  @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">@lang('contents.password')</label>
                                    <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-rounded btn-primary btn-block mt-2">@lang('contents.sign_in')</button>
                                <br>
                                <p class="text-center">&copy; {{ now()->year }}&nbsp; {{config('app.name')}}</strong></p>
                            </form>
                                </div>
                          
                        </div>
                    </div> 
                   
                </div>
                </div>
        </div>
    </div>


@endsection
