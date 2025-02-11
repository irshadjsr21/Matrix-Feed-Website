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
                <h2 class="card-title text-center mb-4">{{ __('Sign Up') }}</h2>

                <form method="POST" action="/signup">
                    @csrf
                    <set-redirect></set-redirect>

                    <div class="row mb-2">
                        <div class="col">
                            <a href="/oauth/facebook" class="btn btn-fb btn-lg btn-social btn-block"> 
                                <span class="mr-2"><i class="fab fa-facebook-f"></i></span> 
                                <span>Signup with Facebook</span>
                            </a>
                        </div>
                    </div>
    
                    <div class="row mb-2">
                        <div class="col">
                            <a href="/oauth/google" class="btn btn-lg btn-social btn-block d-flex justify-content-center align-items-center"> 
                                <span class="mr-2"><img width="25" height="25" src="/static images/google.png" alt="Google logo" /></span> 
                                <span>Signup with Google</span>
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
                            <input placeholder="First Name" id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Last Name" id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" autocomplete="lastName" autofocus>

                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Sign Up') }}
                        </button>
                    </div>

                    <div class="row justify-content-center">
                        Already have an account? &nbsp; <a href="/login">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
