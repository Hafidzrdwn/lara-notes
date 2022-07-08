@extends('layouts.main', ['title' => 'Workspaces'])

@section('content')
    <section class="mt-5">
        <h2 class="text-center">Public Workspaces <i class="fas fa-space-shuttle"></i></h2>
        <div class="row mt-5">
            @auth
                <div class="col-lg-3">
                    <a class="text-decoration-none text-dark" href="{{ route('space.create') }}">
                        <div class="card card-custom shadow-sm">
                            <div
                                class="card-body bg-dark text-center d-flex flex-column justify-content-center align-items-center gap-3">
                                <img width="80" src="/images/plus-circle-solid.svg" alt="">
                                <h5 class="text-danger">Create New Workspace</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endauth
            @foreach ($spaces as $s)
                <div class="col-lg-3">
                    <div class="card card-custom border-danger shadow-sm mb-5 position-relative">
                        @php
                            $isOwner = Auth::check() && $s->user->username === auth()->user()->username;
                        @endphp
                        @if ($isOwner)
                            <div class="card-header bg-white border-0">
                                <div class="dropdown text-end">
                                    <i class="fas fa-ellipsis-v" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;"></i>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('space.edit', $s->slug) }}"><i
                                                    class="fas fa-pencil-alt me-1"></i>
                                                Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('space.destroy', $s->slug) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure??')">
                                                    <i class="fas fa-trash-alt me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="card-body text-center">
                            <h4
                                class="card-title
                                @if (!$isOwner) mt-4 @endif
                            mb-4">
                                {{ $s->title }}</h4>
                            <p class="card-text text-desc">
                                {{ Str::limit($s->desc, 37, '...') }}
                            </p>
                        </div>
                        <div class="card-footer text-center border-0 position-absolute bottom-0 w-100">
                            <a class="text-danger"
                                href="@if ($s->is_example) {{ route('space.example', $s->slug) }} @else {{ route('space', $s->slug) }} @endif"><i
                                    class="fas fa-folder-open"></i> Enter
                                workspace..
                            </a>
                            <p class="mt-2">Created By :
                                <span class="badge bg-dark">{{ '@' . $s->user->username }}
                                </span>
                            </p>
                            <span class="small text-secondary">{{ $s->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
    </section>
@endsection
