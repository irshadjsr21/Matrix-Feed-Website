@extends('../../layouts/app')

@section('content')
<div class="container">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <h1>{{ $author->firstName . ' ' . $author->lastName }}</h1>
    <br>
    
    <div class="card mb-4">
      <h4 class="card-header">About</h4>
      <div class="card-body">
        <div>{{ $author->about }}</div>
        <div class="card-subtitle text-muted text-right mr-4 mb-2">Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($author->created_at) }}"/></div>
        <div class="card-subtitle text-muted text-right mr-4 mb-2">Updated on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($author->updated_at) }}"/></div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Email</h4>
            <div class="card-body">
              {{ $author->email }}
            </div>
          </div>
      </div>
    </div>
    
    <a href="/admin/author/{{$author->id}}/edit" class="btn btn-primary">Edit</a>
  <form action="/admin/author/{{$author->id}}/delete" method="post" class="float-right">
    @csrf
    <button class="btn btn-danger">Delete</button>
  </form>
</div>
@endsection