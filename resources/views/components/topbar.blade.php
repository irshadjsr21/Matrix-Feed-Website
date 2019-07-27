<div class="topbar-container">
  <div class="container">
    <div class="topbar">
      <div class="topbar-header">
        <input type="checkbox" id="nav-toggle" name="nav-toggle" class="nav-toggle-input">
        <div class="logo">
          <h1><span class="text-primary font-weight-bold">Matrix</span> Feed</h1>
        </div>

        <label for="nav-toggle" class="nav-toggle">
          <i class="fas fa-bars"></i>
        </label>

        <div class="ad-space">
          
        </div>

        <nav class="topbar-nav">
          <a href="/">Home</a>
          @isset($categories)
            @foreach ($categories as $category)
              <a href="/category/{{ $category->slug() }}">{{ $category->name }}</a>              
            @endforeach    
          @endisset
        </nav>
      </div>
    </div>
  </div>
</div>