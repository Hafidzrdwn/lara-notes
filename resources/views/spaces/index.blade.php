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

</style>
@endsection

@section('content')
<section class="mt-5">
  <h2 class="text-center">Public Workspaces <i class="fas fa-space-shuttle"></i></h2>
  @if ($msg = Session::get('success'))
  <div class="row justify-content-center align-items-center mt-4">
    <div class="col-lg-6">
      <x-alert>
        @slot('class')
        alert-success
        @endslot
        @slot('msg')
        {!! $msg !!}
        @endslot
      </x-alert>
    </div>
  </div>
  @endif
  <div class="row justify-content-center align-items-center @if(Session::has('success')) mt-4 @else mt-5 @endif">
    @foreach ($spaces as $s)
    @php
    $isOwner = Auth::check() && $s->user->username === auth()->user()->username;
    @endphp
    <div class="col-lg-4">
      <div class="card card-custom mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <div>
            <img class="rounded-circle me-1" width="35" src="{{ asset('images/default.jpg') }}" alt="">
            <a class="text-decoration-none text-dark" href="">{{ $s->user->username }}</a>
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
            <a class="btn btn-danger" href="@if ($s->is_example) {{ route('space.example', $s->slug) }}?page=spaces @else {{ route('space', $s->slug) }}?page=spaces @endif"><i class="fas fa-folder-open me-2"></i>Enter</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    {{-- <div class="col-lg-3">
      <div class="card card-custom border-danger shadow-sm mb-5 position-relative">
  <div class="card-body text-center">
    <h4 class="card-title
                                @if (!$isOwner) mt-4 @endif
                            mb-4">
      {{ $s->title }}</h4>
    <p class="card-text text-desc">
      {{ Str::limit($s->desc, 37, '...') }}
    </p>
  </div>
  <div class="card-footer text-center border-0 position-absolute bottom-0 w-100">
    <a class="text-danger" href="@if ($s->is_example) {{ route('space.example', $s->slug) }}?page=spaces @else {{ route('space', $s->slug) }}?page=spaces @endif"><i class="fas fa-folder-open"></i> Enter
      workspace..
    </a>
    <p class="mt-2">Created By :
      <span class="badge bg-dark">{{ '@' . $s->user->username }}
      </span>
    </p>
    <span class="small text-secondary">{{ $s->created_at->diffForHumans() }}</span>
  </div>
  </div>
  </div>--}}
  @guest
  <div class="col-lg-3">
    <a class="text-decoration-none text-dark" href="{{ route('login') }}">
      <div class="card card-custom border-danger shadow-sm mb-5">
        <div class="card-body d-flex flex-column align-items-center justify-content-center  text-center">
          <i class="fas fa-exclamation-triangle text-danger mb-3 icon-large"></i>
          <h5 class="text-center">Please login to see all workspaces..</h5>
        </div>
      </div>
    </a>
  </div>
  @endguest
  </div>
  {{ $spaces->links() }}
</section>
@endsection
