@extends('../layouts/default')

@section('content')
  <div class="my-4">
    <h1>{{ $title }}</h1>
    <posts-display v-bind:posts="{{ json_encode($posts) }} "></posts-display>
    <div>
        {{$posts->links()}}
    </div>
  </div>
@endsection