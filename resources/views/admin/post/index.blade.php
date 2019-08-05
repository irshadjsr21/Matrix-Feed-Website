@extends('../../layouts/app')

@section('content')
<div class="container">
    <h1 class="row justify-content-between">
        <div class="col">Posts</div>     
        <div class="col text-right"><a href="/admin/posts/add" class="btn btn-primary">Add New</a></div>
    </h1>
    <br>

    @if( count($posts) > 0)
        @foreach($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                <h3 class="card-title"><a href="/admin/posts/{{$post->id}}" class="text-dark">{{$post->title}}</a></h3>
                <h6 class="card-subtitle text-muted mb-2">Written on {{$post->created_at}}</h6>
            </div>
            </div>
        @endforeach
    @else
        <p>No post found</p>
    @endif

    <div>
        {{$posts->links()}}
    </div>
</div>
@endsection