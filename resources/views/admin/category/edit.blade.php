@extends('../../layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
          <div class="card">
              <div class="card-header">{{ __('Edit Category') }}</div>

              <div class="card-body">
              <form method="POST" action="/admin/category/{{$category->id}}/edit">
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-2 col-form-label text-md-right">{{ __('name') }}</label>

                          <div class="col-10">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" autocomplete="name" autofocus>

                              @error('name')
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