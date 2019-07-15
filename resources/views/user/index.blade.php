@extends('../layouts/default')

@section('content')
  <div class="my-4">
    <h1>{{ $title }}</h1>
    <posts-display v-bind:posts="{{ json_encode($posts) }} ">
        <div class="loader"></div>      
    </posts-display>
    <div>
        {{$posts->links()}}
    </div>
  </div>
@endsection