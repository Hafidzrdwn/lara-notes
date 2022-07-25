<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-4">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/space') ? 'active' : '' }}" href="{{ route('dashboard.space') }}">
          <span data-feather="folder" class="align-text-bottom"></span>
          Your workspaces
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="users" class="align-text-bottom"></span>
          Teams
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="globe" class="align-text-bottom"></span>
          Friends
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
      <span class="text-dark">Starred</span>
      <span data-feather="star" class="align-text-bottom text-dark"></span>
    </h6>
    <ul class="nav flex-column mb-4">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Workspaces
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Projects
        </a>
      </li>
    </ul>

    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('spaces') }}">
          <span data-feather="chevrons-left" class="align-text-bottom"></span>
          Back to Workspaces..
        </a>
      </li>
    </ul>

  </div>
  <footer style="margin-top:150px !important;">
    <p class="text-center text-dark">&copy; {{ date('Y') }} LaraNotes</p>
  </footer>
</nav>
