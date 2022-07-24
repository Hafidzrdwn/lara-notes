<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark">
  <div class="container">
    <a class="navbar-brand text-danger fw-bold" href="/">LaraNotes</a>
    @if ($title == "Dashboard")
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @else
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @endif
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
        <a class="nav-link {{ Request::is('spaces') ? 'active' : '' }}" href="{{ route('spaces') }}">Workspaces</a>
      </div>
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
            <img class="ms-1 rounded-circle" id="profile-nav" width="30" src="@if(auth()->user()->profile_image) {{ asset('storage/' . auth()->user()->profile_image) }} @else {{ asset('images/default.jpg') }}@endif" alt="">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('user.profile') }}">
                <i class="fas fa-user me-1"></i> My Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('dashboard') }}">
                <i class="fas fa-th-large me-1"></i> Dashboard
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item dropdown-item-danger text-danger" onclick="return confirm('Are you sure to logout??')">
                  <i class="fas fa-sign-out-alt me-1"></i>
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
        @else
        <a href="{{ route('login') }}" class="nav-link {{ Request::is('auth') ? 'active' : '' }}"><i class="fas fa-sign-in-alt"></i>
          Login
        </a>
        @endauth
      </ul>
    </div>
  </div>
</nav>
