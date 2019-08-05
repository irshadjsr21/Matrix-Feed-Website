<div class="header-container">
    <div class="container">
      <div class="header">
        <div class="col-12">
          <div class="row">
            <div class="col-12 text-center">
              <h4>Matrix Feed Admin Panel</h4>
            </div>
            <div class="col-12 text-center">
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