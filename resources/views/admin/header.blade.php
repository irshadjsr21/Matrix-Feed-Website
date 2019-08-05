<div class="header-container">
    <div class="container">
      <div class="header">
        <div class="col-12">
          <div class="row">
            <div class="col-12 text-center">
              <h4>Matrix Feed Admin Panel</h4>
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