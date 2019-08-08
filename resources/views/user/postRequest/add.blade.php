@extends('../layouts/default')


@section('content')
  <div class="my-4">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div>
      <h1 class="mb-2">Add Post Request</h1>

      <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/post-request/add" enctype="multipart/form-data">
                        @csrf
  
                        <div class="form-group row">
                            <label for="title" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
  
                            <div class="col-12 col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus required>
  
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="image" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-12 col-md-10">
                                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" autofocus required>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          </div>
  
                        <div class="form-group row">
                            <label for="body" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Body') }}</label>
  
                            <div class="col-12 col-md-10">
                                <textarea type="text" class="form-control @error('body') is-invalid @enderror" name="body" autocomplete="current-body">{{ old('body') }}</textarea>
  
                                @error('body')
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
  </div>
@endsection