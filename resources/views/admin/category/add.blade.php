@extends('../../layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
        <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
          <div class="card">
              <div class="card-header">{{ __('Add Category') }}</div>

              <div class="card-body">
                  <form method="POST" action="/admin/category">
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-12 col-md-10">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                              @error('name')
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