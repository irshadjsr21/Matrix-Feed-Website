<div class="header-container">
  <div class="container">
    <div class="header">
      <div class="col-sm-8 col-12">
        <a href="#" class="header-link">About</a>
        <a href="#" class="header-link">Contact</a>
        @guest
        <a href="/signup" class="header-link">Sign up</a>
        <a href="/login" class="header-link">Login</a>
        @else
        <a href="/profile" class="header-link">Profile</a>
        <a href="/logout" class="header-link"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
        </a>
        @endguest
      </div>
      <div class="col-sm-4 col-12">
        <div class="icon-container">
          <a href="https://www.facebook.com/Matrixfeed-101557257861231/" target="blank"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/feed_matrix" target="blank"><i class="fab fa-twitter"></i></a>
          <a href="#" target="blank"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<form id="logout-form" action="/logout" method="POST" style="display: none;">
    @csrf
</form>