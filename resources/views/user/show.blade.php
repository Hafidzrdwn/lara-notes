@extends('layouts.main', ['title' => $user->username])

@section('style')
<style>
  .user-attr:hover {
    text-decoration: underline !important;
    color: #3459e6 !important;
  }

  .user-social {
    transition: .4s;
  }

  .user-social:hover {
    transform: translateY(-10px);
  }

  .username-text {
    margin-top: 90px;
  }

</style>
@endsection

@section('content')
<section class="mt-5 pt-5 pb-4">
  <div class="row align-items-start justify-content-center">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body text-center position-relative">
          <img src="@if($user->profile_image) {{ asset('storage/' . $user->profile_image) }} @else {{ asset('images/default.jpg') }} @endif" width="140" class="img-fluid rounded-circle position-absolute border border-dark start-50 translate-middle" id="user-profile" alt="photo profile">
          <h3 class="username-text">{{ $user->name }}</h3>
          <p class="text-muted">{{ '@' . $user->username }}</p>
          <div class="d-flex justify-content-around align-items-center my-4">
            <div>
              <h5 class="fw-bold">{{ $user->spaces->count() }}</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Workspaces</a>
            </div>
            <div>
              <h5 class="fw-bold">1</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Followers</a>
            </div>
            <div>
              <h5 class="fw-bold">1</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Following</a>
            </div>
          </div>
          @if ($user->bio)
          <p>{{ $user->bio }}</p>
          @endif
          <div class="d-flex align-items-center justify-content-center gap-5 my-4">
            @php
            $icon = ['fa-instagram', 'fa-twitter', 'fa-github'];
            $link = ['https://www.instagram.com/', 'https://twitter.com/', 'https://github.com/'];
            @endphp
            @if ($user->social && $user->attr)
            @foreach ($user->attr as $key => $item)
            @if ($item != 'null')
            <a href="{{ $link[$key] . $item }}" class="text-dark user-social" target="_blank">
              <i class="fab {{ $icon[$key] }} fs-4"></i>
            </a>
            @endif
            @endforeach
            @endif
          </div>
          <div class="mb-4">
            <button class="btn btn-primary w-100">Follow</button>
          </div>
          <span class="text-primary small"><i class="fas fa-calendar-alt me-2"></i>Join {{ $user->created_at->diffForHumans() }}</span>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h2 class="text-center mt-2 mb-4">User Activities</h2>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
