@extends('../layouts/default')

@section('content')
  <div class="my-4">
    <h1>Home</h1>
    <post-showcase></post-showcase>
    <timeline-list v-bind:posts="{{ json_encode($posts) }} "></timeline-list>
    <div>
        {{$posts->links()}}
    </div>
  </div>
@endsection