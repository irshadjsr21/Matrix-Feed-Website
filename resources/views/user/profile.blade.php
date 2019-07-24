@extends('../layouts/default')

@section('content')
  <div class="my-4">
    <h1 class="mb-4">My Profile</h1>

    <user-profile v-bind:user="{{ json_encode(Auth::user()) }} ">
      <div class="loader"></div>
    </user-profile>
  </div>
@endsection