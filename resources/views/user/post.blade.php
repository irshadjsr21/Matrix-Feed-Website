@extends('../layouts/default')

@section('content')
  <div class="my-4 post">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div class="post-meta">
      <h1>{{ $post->title }}</h1>
      <div class="post-details">
        <span class="post-author">by {{ $post->author }}</span>
        <span class="post-date"> - <date-format v-bind:date="{{ json_encode($post->created_at) }}"></date-format></span>
      </div>
    </div>
    <div class="image-container-full">
      <img src="{{ $post->image}}" alt="{{$post->title}} image">
    </div>
    <div class="post-body">
        {!! $post->body !!}
    </div>
  </div>
@endsection