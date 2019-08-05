@extends('../../layouts/app')

@section('content')
<div class="container">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <h1 class="row justify-content-between">
        <div class="col">{{ $category->name }}</div>     
        <div class="col text-right"><a href="/admin/posts/add" class="btn btn-primary">Add Post</a></div>
    </h1>

    @if( count($posts) > 0)
    <h2 class="text-center">Posts in this category</h2>
    <br>
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 align-items-strech mb-4">
                <div class="card h-100">
                    <img src="{{ $post->image }}" height="200" class="card-img-top" alt="{{ $post->title }}"/>
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text"><truncate-text v-bind:text="{{ json_encode($post->description) }}" v-bind:len="150" /></p>
                      <div class="text-muted text-right mb-2">- {{ $post->author }}</div>
                      <div class="text-muted mb-4">
                          <div>Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->created_at) }}"></date-format></div>
                          <div>Updated on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->updated_at) }}"></date-format></div>
                      </div>
                    </div>
                    <div class="w-100 pl-4 pr-4 pb-4" style="margin-top: -1.25rem"><a href="/admin/posts/{{$post->id}}" class="w-100 btn btn-primary">View</a></div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <h2 class="text-center">No Post in this category</h2>
    <br>
    @endif

    <a href="/admin/category/{{$category->id}}/edit" class="btn btn-primary">Edit Category</a>
    <form action="/admin/category/{{$category->id}}/delete" method="post" class="float-right">
      @csrf
      <button class="btn btn-danger">Delete Category</button>
    </form>
</div>
@endsection