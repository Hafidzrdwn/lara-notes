@extends('layouts.dashboard', ['title' => $space->title . ' projects'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">{{ $space->title }} all projects</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Status</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($projects as $p)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $p->title }}</td>
          <td>{{ $p->category->name }}</td>
          <td>@if($p->security) private @else public @endif</td>
          <td>{{ $p->created_at->diffForHumans() }}</td>
          <td>
            <a href="#" class="link-primary me-2 text-decoration-none">
              <span data-feather="edit"></span>
            </a>
            <a href="#" class="link-danger text-decoration-none">
              <span data-feather="trash-2"></span>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</main>

@endsection
