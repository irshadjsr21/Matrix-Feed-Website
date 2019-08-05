@extends('../../layouts/app')

@section('content')
<div class="container">
    <h1 class="row justify-content-between">
        <div class="col">Categories</div>     
        <div class="col text-right"><a href="/admin/category/add" class="btn btn-primary">Add New</a></div>
    </h1>
    <br>
    @if( count($categories) > 0)
        @foreach($categories as $category)
            <div class="card mb-2">
                <div class="card-body">
                <h3 class="card-title"><a href="/admin/category/{{$category->id}}" class="text-dark">{{$category->name}}</a></h3>
                <h6 class="card-subtitle text-muted mb-2">Created at {{$category->created_at}}</h6>
            </div>
            </div>
        @endforeach
    @else
        <p>No category found</p>
    @endif

    <div>
        {{$categories->links()}}
    </div>
</div>
@endsection