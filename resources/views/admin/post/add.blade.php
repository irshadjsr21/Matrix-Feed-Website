@extends('../../layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
        <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
          <div class="card">
              <div class="card-header">{{ __('Add Post') }}</div>

              <div class="card-body">
                  <form method="POST" action="/admin/posts" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group row">
                          <label for="title" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                          <div class="col-12 col-md-10">
                              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                              @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="authorId" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Author') }}</label>

                        <div class="col-12 col-md-10">
                            <select id="authorId" class="form-control @error('authorId') is-invalid @enderror" name="authorId" autofocus>
                                <option value="-1">[Null]</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author->id}}">{{  $author->firstName . ' ' . $author->lastName }}</option>
                                @endforeach
                            </select>

                            @error('authorId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      <div class="text-center my-2">
                        <strong>OR</strong>
                      </div>

                      <div class="form-group row">
                            <label for="author" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Author Name') }}</label>

                            <div class="col-12 col-md-10">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" autocomplete="author" autofocus>

                                <small>
                                    <strong>Keep this empty if you're providing the Author from dropdown.</strong>
                                </small>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="image" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-12 col-md-10">
                                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="category" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-12 col-md-10">
                                    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" autofocus>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                      <div class="form-group row">
                          <label for="body" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Body') }}</label>

                          <div class="col-12 col-md-10">
                              <textarea id="text-editor" type="text" class="form-control @error('body') is-invalid @enderror" name="body" autocomplete="current-body">{{ old('body') }}</textarea>

                              @error('body')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                            <label for="description" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
  
                            <div class="col-12 col-md-10">
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="current-description">{{ old('description') }}</textarea>
  
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keywords" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Keywords') }}</label>
  
                            <div class="col-12 col-md-10">
                                    <input id="keywords" type="text" class="form-control @error('keywords') is-invalid @enderror" name="keywords" value="{{ old('keywords') }}" autocomplete="keywords" autofocus>
  
                                @error('keywords')
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
