@extends('layouts.main', ['title' => $space->title])

@section('content')
    @auth
        <section class="my-5">
            <h1 class="text-center fw-bold">{{ $space->title }}</h1>
            <p class="text-center">{{ $space->desc }}</p>
            <div class="row mt-5 mb-5 align-items-center justify-content-between">
                <div class="col-lg-6">
                    <a href="{{ route('spaces') }}">
                        <i class="fas fa-arrow-left fs-5 bg-dark text-light p-3 rounded-circle"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-end">
                    @if (auth()->user()->username == $space->user->username)
                        <a href="{{ route('project.create', $space->slug) }}" class="btn btn-danger">
                            <i class="fas fa-folder-plus"></i> &nbsp;Add new project
                        </a>
                    @else
                        <button type="button" id="show-profile" class="btn btn-danger">
                            <i class="fas fa-user-astronaut"></i> &nbsp;Show owner profile
                        </button>
                    @endif
                </div>
            </div>
            @php
                $authState = auth()->user()->username != $space->user->username;
            @endphp
            @if ($authState)
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
            @if ($msg = Session::get('success'))
                <div class="row mb-3">
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
            <div
                class="row
                @if ($space->projects->count() <= 0) justify-content-center align-items-center gap-4 @endif
            ">
                @forelse ($space->projects as $p)
                    <div class="col-lg-4">
                        <div class="card card-custom shadow-sm mb-4" style="max-height: 265px;">
                            <div class="card-header row justify-content-between align-items-center">
                                <div class="col-lg-6">
                                    <i class="fas fa-calendar-alt"></i> &nbsp;{{ $p->created_at->diffForHumans() }}
                                </div>
                                @if (Auth::check() && $space->user->username === auth()->user()->username)
                                    <div class="col-lg-6">
                                        <div class="dropdown text-end">
                                            <i class="fas fa-ellipsis-h fs-5" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false" style="cursor: pointer;"></i>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item" href=""><i
                                                            class="fas fa-pencil-alt me-1"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('project.destroy', [
                                                            'space' => $space->slug,
                                                            'project' => $p->slug,
                                                        ]) }}"
                                                        method="post">
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
                @empty
                    <div class="col-lg-4">
                        <img class="w-100" src="{{ asset('images/empty.svg') }}" alt="">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bold">
                            @if ($authState)
                                OMG, This is empty workspace!
                            @else
                                Hey {{ auth()->user()->username }}, your workspace is empty!!
                            @endif
                        </h2>
                        <p class="mt-3 text-dark">
                            @if ($authState)
                                This workspace doesn't contain any projects, the owner doesn't add any projects at all.
                            @else
                                Don't let your workspace go unnoticed, let's try to add a new project by
                                pressing the red <a href="">add
                                    new project</a> button above 👆
                            @endif
                        </p>
                    </div>
                @endforelse
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
            if (content == "Show owner profile") {
                this.innerHTML = '<i class="fas fa-user-ninja"></i> &nbsp;Hide owner profile'
                profile.classList.remove('d-none')
            } else {
                this.innerHTML = '<i class="fas fa-user-astronaut"></i> &nbsp;Show owner profile'
                profile.classList.add('d-none')
            }
        })
    </script>
@endsection
