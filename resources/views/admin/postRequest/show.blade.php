@extends('../../layouts/app')

@section('content')
<div class="container">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <h1>{{ $post->title }}</h1>
    <br>

    <h3 class="text-muted text-center">
      @if($post->status == 'process')
        <div class="mb-2">Status : <strong>In Process</strong></div>
      @endif
      @if($post->status == 'accepted')
        <div class="mb-2">Status : <strong class="text-success">Published</strong></div>
      @endif
      @if($post->status == 'rejected')
        <div class="mb-2">Status : <strong class="text-danger">Rejected</strong></div>
      @endif
      @if($post->review)
      <div class="mb-2">Admin Review : <strong>{{ $post->review }}</strong></div>
        @endif
      @if($post->post_id) 
        <div class="mb-2"><a class="btn btn-secondary" href="/admin/posts/{{$post->post_id}}">View</a></div>
      @endif
    </h3>
    <br>
    <div class="card mb-4">
      <h4 class="card-header">Body</h4>
      <div class="card-body">
        <div>{{ $post->body }}</div>
        <div class="text-muted text-right mr-4 mb-4">
          <span>- {{ $user->firstName . ' ' . $user->lastName }}</span>
        </div>
        <div class="card-subtitle text-muted text-right mr-4 mb-2">Created on <date-format v-bind:islong="1" v-bind:date="{{ json_encode($post->created_at) }}"/></div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12 col-md-6 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Image</h4>
            <div class="card-body">
              <div class="row justify-content-center p-4"><img src="{{$post->image}}" class="w-100" alt="{{ $post->title }}"/></div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Written By</h4>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-6"><strong>Name :</strong> {{ $user->firstName . ' ' . $user->lastName }}</div>
                <div class="col-12 col-md-6"><strong>Email :</strong> {{ $user->email }}</div>
                <div class="col-12 col-md-6"><strong>About :</strong> {{ $user->about }}</div>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    @if($post->status == 'process')
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-header">Accept</div>
          <div class="card-body">
            <form method="POST" action="/admin/post-request/{{ $post->id }}/accept">
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-12 col-md-10">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : $post->title }}" autocomplete="title" autofocus>

                        @error('title')
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
                        <textarea id="text-editor" type="text" class="form-control @error('body') is-invalid @enderror" name="body" autocomplete="current-body">{{ old('body') ? old('body') : $post->body }}</textarea>

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
                  
                  <div class="form-group row">
                      <label for="review" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Review for Author') }}</label>

                      <div class="col-12 col-md-10">
                              <input id="review" type="text" class="form-control @error('review') is-invalid @enderror" name="review" value="{{ old('review') }}" autocomplete="review" autofocus>

                          @error('review')
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
                                    {{ __('Accept') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12">
          <div class="card">
            <div class="card-header">Reject</div>
            <div class="card-body">
              <form method="POST" action="/admin/post-request/{{ $post->id }}/reject">
                  @csrf
  
                    <div class="form-group row">
                        <label for="review" class="col-12 col-md-2 col-form-label text-md-right">{{ __('Review for Author') }}</label>
  
                        <div class="col-12 col-md-10">
                                <input id="review" type="text" class="form-control @error('review') is-invalid @enderror" name="review" value="{{ old('review') }}" autocomplete="review" autofocus>
  
                            @error('review')
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
                                  <button type="submit" class="btn btn-danger">
                                      {{ __('Reject') }}
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    @endif

    <form action="/admin/post-request/{{$post->id}}/delete" method="post" class="text-right">
      @csrf
      <button class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection