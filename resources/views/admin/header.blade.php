<div class="header-container">
    <div class="container">
      <div class="header">
        <div class="col-12">
          <div class="row">
            <div class="col-12 text-center">
              @if (Auth::user()->isAdmin())
                <h4>Matrix Feed Admin Panel</h4>  
              @else
                <h4>Matrix Feed Author Panel</h4>                  
              @endif
              <h5>Welcome {{ Auth::user()->firstName }}</h5>
            </div>
            <div class="col-12 text-center">
              <a href="/" class="header-link" target="_blank">Home Page</a>
              <a href="/logout" class="header-link"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <form id="logout-form" action="/logout" method="POST" style="display: none;">
      @csrf
  </form>