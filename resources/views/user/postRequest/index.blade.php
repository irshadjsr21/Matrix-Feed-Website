@extends('../layouts/default')


@section('content')
  <div class="my-4">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div>
      <h1 class="mb-2">Written Something Interesting?</h1>

      <div class="row justify-content-center my-4 py-4 text-center" style="font-size: 1.25rem;">
        <div class="col-lg-6 col-md-8 col-sm-10 col-12 mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
        <div class="col-12">
          <a href="/post-request/add" class="btn btn-primary btn-lg">Add Article</a>
        </div>
      </div>

      <div class="my-4">
        <h2 class="text-center mb-4">Your Requested Articles</h2>
        @if( count($posts) > 0)
          <div class="row">
              @foreach($posts as $post)
                  <div class="col-md-4 align-items-strech mb-4">
                      <div class="card h-100">
                          <img src="{{ $post->image }}" height="200" class="card-img-top" alt="{{ $post->title }}"/>
                          <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"><truncate-text v-bind:text="{{ json_encode($post->body) }}" v-bind:len="150" /></p>
                            <div class="text-muted mb-4">
                                <div>Created on <date-format v-bind:islong="true" v-bind:date="{{ json_encode($post->created_at) }}"></date-format></div>
                                @if($post->status == 'process')
                                  <div>Status : <strong>In Process</strong></div>
                                @endif
                                @if($post->status == 'accepted')
                                  <div>Status : <strong class="text-success">Published</strong></div>
                                @endif
                                @if($post->status == 'rejected')
                                  <div>Status : <strong class="text-danger">Rejected</strong></div>
                                @endif
                                @if($post->review)
                                  <div>Admin Review : <strong>{{ $post->review }}</strong></div>
                                @endif
                            </div>
                          </div>
                          <div class="w-100 pl-4 pr-4 pb-4" style="margin-top: -1.25rem">
                            <div class="row">
                              <div class="col"><a href="/post-request/{{$post->id}}" class="btn btn-primary">View</a></div>
                              <div class="col text-right">
                                <form action="/post-request/{{$post->id}}/delete" method="post">
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
        @else
            <h4 class="text-center">No articles found.</h4>
        @endif
      </div>
    </div>
  </div>
@endsection