<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold" href="/">LaraNotes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                <a class="nav-link {{ Request::is('spaces') ? 'active' : '' }}"
                    href="{{ route('spaces') }}">Workspaces</a>
            </div>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <img class="ms-1 rounded-circle" width="25" src="{{ asset('images/default.jpg') }}"
                                alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user me-1"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-th-large me-1"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"
                                        onclick="return confirm('Are you sure to logout??')">
                                        <i class="fas fa-sign-out-alt me-1"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <a href="{{ route('login') }}" class="nav-link {{ Request::is('auth') ? 'active' : '' }}"><i
                            class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                @endauth
            </ul>
        </div>
    </div>
</nav>
