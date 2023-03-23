@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-sm-12 col-md-6">
            <img alt="imatge login" src="img/img_login.png" width="100%"></img>
        </div> 
        <div class="col-sm-12 col-md-6">
            <div class="row card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
             
                    
                    <div class="card-header">{{ __('fields.Login') }}</div>

                    <div class="card-body">
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('fields.Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('fields.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('fields.Remember Me') }}
                                    </label>
                                </div>
                            </div>

                        <div class="row mb-0">
                            <div class="col-md-7  offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('fields.Login') }}
                                </button>
                                
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('fields.Forgot Your Password?') }}
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="btn btn-link" href="{{ route('register') }}">{{ __('fields.Register') }}</a>
                                @endif
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
@endsection
