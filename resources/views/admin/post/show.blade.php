@extends('../../layouts/app')

@section('content')
<div class="container">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <h1>{{ $post->title }}</h1>
    <br>
    
    <div class="card mb-4">
      <h4 class="card-header">Body</h4>
      <div class="card-body">
        <div>{!! $post->body !!}</div>
        <div class="text-muted text-right mr-4 mb-4">- {{ $post->author }}</div>
        <div class="card-subtitle text-muted text-right mr-4 mb-2">Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->created_at) }}"/></div>
        <div class="card-subtitle text-muted text-right mr-4 mb-2">Updated on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->updated_at) }}"/></div>
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
          <h4 class="card-header">Description</h4>
          <div class="card-body">
            {{ $post->description }}
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Keywords</h4>
          <div class="card-body">
            {{ $post->keywords }}
          </div>
        </div>
      </div>

      @isset($category)
        <div class="col-12 col-md-6 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Category</h4>
            <div class="card-body">
              {{ $category->name }}
            </div>
          </div>
        </div>
      @endisset
    </div>
    
    <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
  <form action="/admin/posts/{{$post->id}}/delete" method="post" class="float-right">
    @csrf
    <button class="btn btn-danger">Delete</button>
  </form>
</div>
@endsection