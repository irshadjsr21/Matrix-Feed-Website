@extends('../layouts/default')


@section('content')
  <div class="my-4 post">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div class="post-meta">
      <h1>{{ $post->title }}</h1>
      <div class="post-details">
        <span class="post-author t-mute">by 
          <span>{{ Auth::user()->firstName }}</span>
        </span>
        <span class="post-date t-mute"> - <date-format v-bind:date="{{ json_encode($post->created_at) }}"></date-format></span>
      </div>
      <div class="text-muted">Note : <strong>Only you can see this page.</strong></div>
    </div>
    @if($addedPost)
    <h2 class="text-center text-muted mb-4">
      Published Article is : <a href="/posts/{{ $addedPost->slug() }}">here</a>
    </h2>
    @endif
    <div class="image-container-full">
      <img src="{{ $post->image }}" alt="{{$post->title}} image">
    </div>
    <div class="post-body">
        {{ $post->body }}
    </div>
  </div>
@endsection