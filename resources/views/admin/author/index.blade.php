@extends('../../layouts/app')

@section('content')
<div class="container">
    <h1 class="row justify-content-between">
        <div class="col">Authors</div>     
        <div class="col text-right"><a href="/admin/author/add" class="btn btn-primary">Add New</a></div>
    </h1>
    <br>
    @if( count($authors) > 0)
        @foreach($authors as $author)
            <div class="card mb-2">
                <div class="card-body">
                <h3 class="card-title"><a href="/admin/author/{{$author->id}}" class="text-dark">{{ $author->firstName . ' ' . $author->lastName}}</a></h3>
                <div class="card-subtitle text-muted mb-2">Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($author->created_at) }}"></date-format></div>
            </div>
            </div>
        @endforeach
    @else
        <h2 class="text-center">No authors found</h2>
    @endif

    <div>
        {{$authors->links()}}
    </div>
</div>
@endsection