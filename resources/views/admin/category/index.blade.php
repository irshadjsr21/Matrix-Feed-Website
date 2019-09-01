@extends('../../layouts/app')

@section('content')
<div class="container">
    <h1 class="row justify-content-between">
        <div class="col">Categories</div>     
        @if(Auth::user()->isAdmin())
            <div class="col text-right"><a href="/admin/category/add" class="btn btn-primary">Add New</a></div>
        @endif
    </h1>
    <br>
    @if( count($categories) > 0)
        @foreach($categories as $category)
            <div class="card mb-2">
                <div class="card-body">
                <h3 class="card-title"><a href="/admin/category/{{$category->id}}" class="text-dark">{{$category->name}}</a></h3>
                <div class="card-subtitle text-muted mb-2">Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($category->created_at) }}"></date-format></div>
                <div class="card-subtitle text-muted">Updated on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($category->updated_at) }}"></date-format></div>
            </div>
            </div>
        @endforeach
    @else
        <h2 class="text-center">No category found</h2>
    @endif

    <div>
        {{$categories->links()}}
    </div>
</div>
@endsection