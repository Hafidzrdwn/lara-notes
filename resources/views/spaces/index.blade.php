@extends('layouts.main', ['title' => 'Workspaces'])

@section('style')
<style>
  .pagination>li>a,
  .pagination>li>span,
  .pagination>li>a:hover {
    color: #212529; // use your own color here
  }

  .pagination>.active>a,
  .pagination>.active>a:focus,
  .pagination>.active>a:hover,
  .pagination>.active>span,
  .pagination>.active>span:focus,
  .pagination>.active>span:hover {
    background-color: #212529;
    border-color: #212529;

  }

  .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #212529;
    border-color: #212529;
  }

  .fa-search {
    top: 50%;
    transform: translateY(-50%);
    left: 25px;
    font-size: 18px;
  }

  #search {
    padding-left: 45px;
  }

  .username-link:hover {
    text-decoration: underline !important;
  }

</style>
@endsection

@section('content')
<section class="mt-5">
  <h2 class="text-center">Public Workspaces <i class="fas fa-space-shuttle"></i></h2>
  <div class="row mt-5">
    <div class="col-md-6 position-relative">
      <input type="text" class="form-control" id="search" placeholder="Search everything..">
      <i class="fas fa-search position-absolute"></i>
    </div>
  </div>
  <div class="row justify-content-center align-items-center mt-4">
    @foreach ($spaces as $s)
    @php
    $isOwner = Auth::check() && $s->user->username === auth()->user()->username;
    @endphp
    <div class="col-lg-4">
      <div class="card card-custom mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <div>
            <img class="rounded-circle me-1" width="35" src="@if($s->user->profile_image) {{ asset('storage/' . $s->user->profile_image) }} @else {{ asset('images/default.jpg') }} @endif" alt="user profile">
            <a class="text-decoration-none text-dark username-link" href="{{ route('user.profile', [
              'user' => $s->user->username
            ]) }}">
              {{ $s->user->username }}
            </a>
          </div>
          @if ($isOwner)
          <div class="dropdown text-end">
            <i class="fas fa-ellipsis-v fs-6" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li>
                <a class="dropdown-item" href="{{ route('space.edit', $s->slug) }}?page=spaces"><i class="fas fa-pencil-alt me-1"></i>
                  Edit</a>
              </li>
              <li>
                <form action="{{ route('space.destroy', $s->slug) }}?page=spaces" method="post">
                  @method('delete')
                  @csrf
                  <button type="submit" class="dropdown-item dropdown-item-danger text-danger" onclick="return confirm('Are you sure??')">
                    <i class="fas fa-trash-alt me-1"></i>
                    Delete
                  </button>
                </form>
              </li>
            </ul>
          </div>
          @endif
        </div>
        <div class="card-body position-relative">
          <h4 class="card-title mt-2 mb-3">{{ Str::title($s->title) }}</h4>
          <p class="card-text">{{ $s->desc }}</p>
          <div class="d-flex align-items-center justify-content-between position-absolute w-100 px-4" style="bottom: 15px; right: 0; left:0;">
            <span class="small text-muted">Created {{ $s->created_at->diffForHumans() }}</span>
            <a class="btn btn-danger" href="{{ route('space', $s->slug) }}?page=spaces"><i class="fas fa-folder-open me-2"></i>Enter</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @guest
    <div class="col-lg-6 text-center load">
      <div class="alert alert-danger mt-3" role="alert">
        Please <a href="{{ route('login') }}" class="alert-link">login</a> to see more workspaces...</div>
    </div>
    @endguest
  </div>
  @if (method_exists($spaces, 'links'))
  {{ $spaces->links() }}
  @endif
</section>

@endsection

@section('script')
@if ($msg = Session::get('loggedin'))
<x-toast>
  @slot('icon')
  success
  @endslot
  @slot('title')
  {{ $msg }}
  @endslot
  @slot('msg')
  Hi {{ auth()->user()->username }}, welcome back!
  @endslot
</x-toast>
@elseif($msg = Session::get('success'))
<x-toast>
  @slot('icon')
  success
  @endslot
  @slot('title')
  {!! $msg !!}
  @endslot
  @slot('msg')
  @endslot
</x-toast>
@elseif ($msg = Session::get('loggedout'))
<x-toast>
  @slot('icon')
  success
  @endslot
  @slot('title')
  {{ $msg }}
  @endslot
  @slot('msg')
  You have been logged out.
  @endslot
</x-toast>
@endif

@endsection
