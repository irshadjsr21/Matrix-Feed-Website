@extends('../../layouts/app')

@section('content')
<div class="container">
    <h1 class="row justify-content-between">
        <div class="col">Posts</div>     
        <div class="col text-right"><a href="/admin/posts/add" class="btn btn-primary">Add New</a></div>
    </h1>
    <br>

    @if( count($posts) > 0)
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 align-items-strech mb-4">
                    <div class="card h-100">
                        <img src="{{ $post->image }}" height="200" class="card-img-top" alt="{{ $post->title }}"/>
                        <div class="card-body">
                          <h5 class="card-title">{{ $post->title }}</h5>
                          <p class="card-text"><truncate-text v-bind:text="{{ json_encode($post->description) }}" v-bind:len="150" /></p>
                          <div class="text-muted text-right mb-2">
                              @if ($post->author_id)
                                <span>- {{ $post->author_firstName . ' ' . $post->author_lastName }}</span>
                              @else
                                <span>- {{ $post->author }}</span>
                              @endif
                            </div>
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
        <h2 class="text-center">No post found</h2>
    @endif

    <div>
        {{$posts->links()}}
    </div>
</div>
@endsection