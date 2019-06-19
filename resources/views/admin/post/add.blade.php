@extends('../../layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
          <div class="card">
              <div class="card-header">{{ __('Add Post') }}</div>

              <div class="card-body">
                  <form method="POST" action="/admin/posts/" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group row">
                          <label for="title" class="col-2 col-form-label text-md-right">{{ __('Title') }}</label>

                          <div class="col-10">
                              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                              @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                            <label for="author" class="col-2 col-form-label text-md-right">{{ __('Author') }}</label>
  
                            <div class="col-10">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" autocomplete="author" autofocus>
  
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="image" class="col-2 col-form-label text-md-right">{{ __('Image') }}</label>
      
                                <div class="col-10">
                                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" autofocus>
      
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                      <div class="form-group row">
                          <label for="body" class="col-2 col-form-label text-md-right">{{ __('Body') }}</label>

                          <div class="col-10">
                              <textarea id="text-editor" type="text" class="form-control @error('body') is-invalid @enderror" name="body" autocomplete="current-body">{{ old('body') }}</textarea>

                              @error('body')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-10 offset-md-2">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Submit') }}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection