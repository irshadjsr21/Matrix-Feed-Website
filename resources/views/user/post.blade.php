@extends('../layouts/default')


@section('content')
  <div class="my-4 post">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div class="post-meta">
      <h1>{{ $post->title }}</h1>
      <div class="post-details">
        <span class="post-author"><span class="t-mute">by</span> 
          @if ($author)
            <a href="/author/{{ $post->author_id }}"><span class="t-mute">{{ $author->firstName . ' ' . $author->lastName }}</span> <i class="fas fa-check-circle"></i></a>
          @else
            <span class="t-mute">{{ $post->author }}</span>
          @endif
        </span>
        <span class="post-date t-mute"> - <date-format v-bind:date="{{ json_encode($post->created_at) }}"></date-format></span>
      </div>
    </div>
    <div class="image-container-full">
      <img src="{{ $post->image}}" alt="{{$post->title}} image">
    </div>
    <div class="post-body">
        {!! $post->body !!}

    
    @if($author)
    <a href="/author/{{$author->id}}" class="text-reset row justify-content-center mb-4 author-section">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center justify-content-around">
              <div class="col-md-4 mb-2">
                <div class="author-avatar" 
                style="backgroundImage: url('{{ $author->avatar }}')">
                </div>
              </div>

              <div class="col-md-8 mb-2">
                <h4 class="mb-2">{{ $author->firstName . ' ' . $author->lastName }}</h4>
                <truncate-text v-bind:text="{{ json_encode($author->about) }}" v-bind:len="120" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    @endif

    <like-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></like-component>
        
        <div class="social-links-container">
          <div>Share : </div>
          <social-share v-bind:post="{{ json_encode($post) }}"></social-share>
        </div>

    <comments-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></comments-component>


    </div>
  </div>
@endsection