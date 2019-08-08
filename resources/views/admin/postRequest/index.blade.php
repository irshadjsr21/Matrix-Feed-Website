@extends('../../layouts/app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <h1 class="col-8">Post Requests</h1>     
        <div class="col text-right filter">
          Filter : 
          <a href="/admin/post-request">All</a> |
          <a href="/admin/post-request?only=process">Process</a> |
          <a href="/admin/post-request?only=accepted">Accepted</a> |
          <a href="/admin/post-request?only=rejected">Rejected</a>
        </div>
    </div>
    <br>

    @if( count($posts) > 0)
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 align-items-strech mb-4">
                    <div class="card h-100">
                        <img src="{{ $post->image }}" height="200" class="card-img-top" alt="{{ $post->title }}"/>
                        <div class="card-body">
                          <h5 class="card-title">{{ $post->title }}</h5>
                          <p class="card-text"><truncate-text v-bind:text="{{ json_encode($post->body) }}" v-bind:len="150" /></p>
                          <div class="text-muted mb-4">
                              <div>Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->created_at) }}"></date-format></div>
                              @if($post->status == 'process')
                              <div>Status : <strong>In Process</strong></div>
                              @endif
                              @if($post->status == 'accepted')
                                <div>Status : <strong class="text-success">Published</strong></div>
                              @endif
                              @if($post->status == 'rejected')
                                <div>Status : <strong class="text-danger">Rejected</strong></div>
                              @endif
                              @if($post->review)
                                <div>Admin Review : <strong>{{ $post->review }}</strong></div>
                              @endif
                          </div>
                        </div>
                        <div class="w-100 pl-4 pr-4 pb-4" style="margin-top: -1.25rem"><a href="/admin/post-request/{{$post->id}}" class="w-100 btn btn-primary">View</a></div>
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