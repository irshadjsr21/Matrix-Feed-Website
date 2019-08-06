@extends('../../layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
        <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
          <div class="card">
              <div class="card-header">{{ __('Edit Author') }}</div>

              <div class="card-body">
                  <form method="POST" action="/admin/author/{{$author->id}}/edit">
                      @csrf

                      <div class="form-group row">
                          <label for="firstName" class="col-12 col-md-2 col-form-label text-md-right">{{ __('First Name') }}</label>

                          <div class="col-12 col-md-10">
                              <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $author->firstName }}" autocomplete="firstName" autofocus>

                              @error('firstName')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                            <label for="lastName" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-12 col-md-10">
                                <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ $author->lastName }}" autocomplete="lastName" autofocus>

                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="email" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>

                          <div class="col-12 col-md-10">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $author->email }}" autocomplete="email" autofocus>

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                      <div class="form-group row">
                            <label for="about" class="col-12 col-md-2 col-form-label text-md-right">{{ __('About') }}</label>
  
                            <div class="col-12 col-md-10">
                                <textarea type="text" class="form-control @error('about') is-invalid @enderror" name="about" autocomplete="current-about">{{ $author->about }}</textarea>
  
                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
  
                            <div class="col-12 col-md-10">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password" autofocus>
                                  <small>
                                      <strong>Password will change if provided else it will be untouched.</strong>
                                  </small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                    <div class="col text-right">
                                        <input class="btn btn-danger" type="button" value="Cancle" onclick="history.back(-1)"/>
                                    </div> 
                                </div>
                            </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
