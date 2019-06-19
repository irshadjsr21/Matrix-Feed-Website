<div class="header-container">
  <div class="container">
    <div class="header">
      <div class="col-sm-8 col-12">
        <a href="#" class="header-link">About</a>
        <a href="#" class="header-link">Contact</a>
        @guest
        <a href="/register" class="header-link">Sign up</a>
        <a href="/login" class="header-link">Login</a>
        @else
        <a href="{{ route('logout') }}" class="header-link"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
        </a>
        @endguest
      </div>
      <div class="col-sm-4 col-12">
        <div class="icon-container">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>