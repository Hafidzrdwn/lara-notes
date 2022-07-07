@extends('layouts.main', ['title' => 'Workspaces'])

@section('content')
    <section class="mt-5">
        <h2 class="text-center">Public Workspaces <i class="fas fa-space-shuttle"></i></h2>
        <div class="row mt-5">
            @auth
                <div class="col-lg-3">
                    <a class="text-decoration-none text-dark" href="{{ route('spaces.create') }}">
                        <div class="card card-custom shadow-sm">
                            <div
                                class="card-body bg-dark text-center d-flex flex-column justify-content-center align-items-center gap-3">
                                <img width="80" src="/images/plus-circle-solid.svg" alt="">
                                <h5 class="text-danger">Create new workspace</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endauth
            @foreach ($spaces as $s)
                <div class="col-lg-3">
                    <a class="text-decoration-none text-dark"
                        href="@if ($s->is_example) {{ route('space.example', $s->slug) }} @else {{ route('space', $s->slug) }} @endif">
                        <div class="card card-custom border-danger shadow-sm mb-5">
                            <div class="card-body text-center">
                                <h4 class="card-title mt-3 mb-4">{{ $s->title }}</h4>
                                <p class="card-text text-desc">
                                    {{ $s->desc }}
                                </p>
                            </div>
                            <div class="card-footer text-center border-0">
                                <p>Created By : <span class="badge bg-dark">{{ '@' . $s->user->username }}</span></p>
                                <span class="small text-secondary">{{ $s->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
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
