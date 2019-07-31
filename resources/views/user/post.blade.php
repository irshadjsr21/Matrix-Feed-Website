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

    <like-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></like-component>
        
        <div class="social-links-container">
          <div>Share : </div>
          {!!
            Share::currentPage('Checkout this awesome article I found on Matrix Feed : ')
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
          !!}
        </div>

    <comments-component v-bind:postid="{{ json_encode($post->id) }}" v-bind:user="{{ json_encode(Auth::user()) }}"><div class="loader loader-sm"></div></comments-component>


    </div>
  </div>
@endsection