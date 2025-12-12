<header class="topnav">
  <div class="container">
    <div class="navbar-wrapper">
      <!-- Left: Logo -->
      <div class="navbar-left">
        @if(isset($company) && $company->logo)
          <img src="{{ asset('storage/' . $company->logo) }}" class="logo-img" alt="{{ $company->company_name ?? 'AOHT' }}">
        @elseif(file_exists(public_path('assets/logo.jpg')))
          <img src="{{ asset('assets/logo.jpg') }}" class="logo-img" alt="AOHT Group">
        @else
          <div class="logo-img" style="font-size: 1.5rem; font-weight: 800; color: var(--accent-1);">AOHT GROUP</div>
        @endif
      </div>

      <!-- Center: Navigation Links -->
      <div class="navbar-links">
        <nav class="flex gap-2 text-sm">
          <a class="nav-link active" href="{{ route('home') }}">Home</a>
          <a class="nav-link" href="#">About</a>
          <a class="nav-link" href="#">Companies</a>
          <a class="nav-link" href="#">Services</a>
          <a class="nav-link" href="#">Careers</a>
          <a class="nav-link" href="#">News</a>
        </nav>
      </div>

      <!-- Right: Cart & Auth Icons -->
      <div class="navbar-right">
        <a class="icon-link" href="#" title="Shopping Cart">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
          </svg>
        </a>
        <a class="icon-link-text" href="{{ route('login') }}" title="Login">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
            <polyline points="10 17 15 12 10 7"></polyline>
            <line x1="15" y1="12" x2="3" y2="12"></line>
          </svg>
          <span>Login</span>
        </a>
        <a class="icon-link-text" href="{{ route('register') }}" title="Register">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span>Register</span>
        </a>
      </div>
    </div>
  </div>
</header>
