@extends('layouts.dashboard', ['title' => 'Your Workspaces'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Your Workspaces</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Number of Projects</th>
          <th scope="col">Status</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($spaces as $s)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $s->title }}</td>
          <td class="text-nowrap">{{ $s->desc }}</td>
          <td>
            {{ $s->projects->count() }} - <a href="{{ route('dashboard.space.show', $s->id) }}" class=" link-primary"> View projects </a>
          </td>
          <td>public</td>
          <td>{{ $s->created_at->diffForHumans() }}</td>
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
