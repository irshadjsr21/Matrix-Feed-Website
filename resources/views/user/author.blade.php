@extends('../layouts/default')


@section('content')
  <div class="my-4">
    <input type="button" class="btn btn-light text-dark mb-2" value="Go Back" onclick="history.back(-1)" />
    <div>
      <h1 class="mb-2">{{ $author->firstName . ' ' . $author->lastName }}</h1>
      <div class="mb-4">
        <div class="row justify-content-center my-4">
          <div
            class="avatar"
            style="backgroundImage: url('{{ $author->avatar }}')"
          ></div>
        </div>
      </div>
      <div>{{ $author->about }}</div>

      <div class="py-4">
        <h2>Posts by {{ $author->firstName }}</h2>
        <posts-display v-bind:posts="{{ json_encode($posts) }}" isauthor="true">
            <div class="loader"></div>      
        </posts-display>
        <div>
            {{$posts->links()}}
        </div>
      </div>
    </div>
  </div>
@endsection