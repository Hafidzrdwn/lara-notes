@extends('layouts.main', ['title' => $space->title])

@section('content')
    @auth
        <section class="my-5">
            <h1 class="text-center fw-bold">{{ $space->title }}</h1>
            <div class="row mt-5 mb-5 align-items-center justify-content-between">
                <div class="col-lg-6">
                    <a href="{{ url()->previous() }}">
                        <i class="fas fa-arrow-left fs-5 bg-dark text-light p-3 rounded-circle"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-end">
                    @if (auth()->user()->username == $space->user->username)
                        <a href="" class="btn btn-danger">
                            <i class="fas fa-folder-plus"></i> &nbsp;Add new project
                        </a>
                    @else
                        <button type="button" id="show-profile" class="btn btn-danger">
                            <i class="fas fa-user-astronaut"></i> &nbsp;Show profile
                        </button>
                    @endif
                </div>
            </div>
            @if (auth()->user()->username != $space->user->username)
                <div id="profile-card" class="row d-none justify-content-center gap-5 align-items-center">
                    <div class="col-lg-5">
                        <img class="w-100" src="{{ asset('images/project.svg') }}" alt="">
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow border-0 rounded">
                            <div class="card-body p-4 text-center">
                                <div class="mx-auto border border-dark rounded-circle"
                                    style="width: 135px ; height: 135px ; background-image: url({{ asset('images/default.jpg') }}); background-size: cover; background-position: top center;">
                                </div>
                                <h3 class="card-title mt-3 mb-2 fw-bold">{{ '@' . $space->user->username }}</h3>
                                <h6 class="text-dark text-opacity-75">{{ $space->user->name }}</h6>
                                <p class="card-text">Workspaces : <span
                                        class="badge @if ($space->user->spaces->count() > 0) {{ 'text-bg-dark' }} @else {{ 'text-bg-danger' }} @endif">
                                        {{ $space->user->spaces->count() }}</span></p>
                                <a href="#" class="btn btn-danger">Go to profile&nbsp;<i class="fas fa-rocket"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <h2 class="my-5">
                Projects ({{ $space->projects->count() }})
            </h2>
            <div class="row">
                @foreach ($space->projects as $p)
                    <div class="col-lg-4">
                        <div class="card card-custom shadow-sm mb-4" style="max-height: 230px; cursor: default;">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt"></i> &nbsp;{{ $p->created_at->diffForHumans() }}
                            </div>
                            <div class="card-body position-relative">
                                <h4>{{ $p->title }}</h4>
                                <span class="badge text-bg-dark">{{ $p->category->name }}</span>
                                @if ($p->security)
                                    <p class="mt-3 text-danger"><i class="fas fa-lock"></i> private project..</p>
                                @endif
                                @php
                                    $state = auth()->user()->username != $space->user->username && $p->security;
                                @endphp
                                <a href="#"
                                    class="
                                position-absolute 
                                d-block 
                                btn 
                                btn-danger
                                @if ($state) {{ 'disabled' }} @endif
                                "
                                    style="right:10px; left:10px; bottom: 10px;">
                                    @if ($state)
                                        <i class="fas fa-lock"></i>
                                    @else
                                        <i class="fas fa-eye"></i>
                                    @endif
                                    View project
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        @include('spaces.example')
    @endauth
@endsection

@section('script')
    <script>
        const btnShowProfile = document.getElementById('show-profile')
        const profile = document.getElementById('profile-card')

        btnShowProfile.addEventListener('click', function() {
            const content = this.textContent.trim()
            if (content == "Show profile") {
                this.innerHTML = '<i class="fas fa-user-ninja"></i> &nbsp;Hide profile'
                profile.classList.remove('d-none')
            } else {
                this.innerHTML = '<i class="fas fa-user-astronaut"></i> &nbsp;Show profile'
                profile.classList.add('d-none')
            }
        })
    </script>
@endsection
