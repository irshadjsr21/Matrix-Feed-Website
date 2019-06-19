@extends('../../layouts/app')

@section('content')
<div class="container">
    <a href="/admin/category" class="btn btn-light text-dark mb-2">Go Back</a>
    <div class="card mb-2">
        <h1 class="card-header">{{$category->name}}</h1>
    <h6 class="card-subtitle text-muted text-right mr-4 mb-2">Written on {{$category->created_at}}</h6>
    </div>
    <a href="/admin/category/{{$category->id}}/edit" class="btn btn-primary">Edit</a>
  <form action="/admin/category/{{$category->id}}/delete" method="post" class="float-right">
    @csrf
    <button class="btn btn-danger">Delete</button>
  </form>
</div>
@endsection