@extends('layouts.main', ['title' => $space->title])

@section('content')
    <section class="mt-5">
        <h2 class="text-center"><i class="fas fa-rocket"></i>&nbsp;{{ $space->title }}</h2>
        <div class="row mt-5 mb-4 align-items-center justify-content-between">
            <div class="col-lg-6">
                <a href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left fs-5 bg-dark text-light p-3 rounded-circle"></i>
                </a>
            </div>
            <div class="col-lg-6 text-end">
                <a href="" class="btn btn-danger">
                    <i class="fas fa-folder-plus"></i> &nbsp;Add new project
                </a>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($space->projects as $p)
                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4" style="max-height: 230px; cursor: default;">
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
