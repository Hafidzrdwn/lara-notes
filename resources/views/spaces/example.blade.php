@extends('layouts.main', ['title' => $space->title])

@section('content')
    <section class="my-5">
        <h1 class="text-center fw-bold">{{ $space->title }}</h1>
        <div class="row mt-5 mb-5 align-items-center justify-content-between">
            <div class="col-lg-6">
                <a href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left fs-5 bg-dark text-light p-3 rounded-circle"></i>
                </a>
            </div>
        </div>
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
                            <a href="#" class="position-absolute d-block btn btn-danger"
                                style="right:10px; left:10px; bottom: 10px;"><i class="fas fa-eye"></i>
                                View project</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
