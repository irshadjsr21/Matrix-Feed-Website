@extends('../layouts/default')


@section('content')
  <div class="my-4 post">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div class="post-meta">
      <h1>{{ $post->title }}</h1>
      <div class="post-details">
        <span class="post-author">by 
          @if ($post->author_id)
            <a href="/author/{{ $post->author_id }}">{{ $post->author_firstName . ' ' . $post->author_lastName }}</a>
          @else
            <span>{{ $post->author }}</span>
          @endif  
        </span>
        <span class="post-date"> - <date-format v-bind:date="{{ json_encode($post->created_at) }}"></date-format></span>
      </div>
    </div>
    <div class="image-container-full">
      <img src="{{ $post->image}}" alt="{{$post->title}} image">
    </div>
    <div class="post-body">
        {!! $post->body !!}

    <like-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></like-component>
        
        <div class="social-links-container">
          <div>Share : </div>
          <social-share v-bind:post="{{ json_encode($post) }}"></social-share>
        </div>

    <comments-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></comments-component>


    </div>
  </div>
@endsection