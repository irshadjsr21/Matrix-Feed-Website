@extends('layouts.auth')

@section('content')
<div class="page-center">
    <div class="auth-card m-2">
        <div class="auth-card-row">
            <div class="auth-l-col auth-bg">
                <div class="row justify-content-center align-items-center m-0 w-100 h-100">
                    <a href="/" class="auth-logo"><img src="/static images/Logo-circle.png" alt="Matrix Feed Logo"></a>
                </div>
            </div>
            <div class="auth-r-col">
                <h2 class="text-center mb-4">{{ __('Login') }}</h2>
                <form method="POST" action="/login">
                    @csrf
                    <set-redirect></set-redirect>

                    <div class="row mb-2">
                        <div class="col">
                            <a href="/oauth/facebook" class="btn btn-fb btn-lg btn-social btn-block"> 
                                <span class="mr-2"><i class="fab fa-facebook-f"></i></span> 
                                <span>Login with Facebook</span>
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <a href="/oauth/google" class="btn btn-lg btn-social btn-block d-flex justify-content-center align-items-center"> 
                                <span class="mr-2"><img width="25" height="25" src="/static images/google.png" alt="Google logo" /></span> 
                                <span>Login with Google</span>
                            </a>
                        </div>
                    </div>

                    @error('oAuth')
                        <span class="invalid-feedback text-center" style="display:block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="row mb-2">
                        <div class="col text-center">OR</div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    @isset($authError)
                        <div class="row mb-2">
                            <div class="col">
                                <span class="invalid-feedback" style="display:block;" role="alert">
                                    <strong>{{ $authError }}</strong>
                                </span>
                            </div>
                        </div>
                    @endisset

                    <div class="form-group row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="row justify-content-center">
                        Don't have an account? &nbsp; <a href="/signup">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
