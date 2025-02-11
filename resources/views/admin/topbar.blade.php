<div class="topbar-container">
    <div class="container">
      <div class="topbar">
        <div class="topbar-header">
          <input type="checkbox" id="nav-toggle" name="nav-toggle" class="nav-toggle-input">
          <a href="/admin" class="logo">
            <img src="/static images/Logo.png" alt="Matrix Feed logo">
          </a>
  
          <label for="nav-toggle" class="nav-toggle">
            <i class="fas fa-bars"></i>
          </label>
  
          <div class="ad-space">
            
          </div>
  
          <nav class="topbar-nav">
            <a href="/admin/posts">Posts</a>
            <a href="/admin/category">Categories</a>
            @if (Auth::user()->isAdmin())
              <a href="/admin/author">Authors</a> 
              <a href="/admin/post-request">Post Requests</a> 
            @endif
          </nav>
        </div>
      </div>
    </div>
  </div>