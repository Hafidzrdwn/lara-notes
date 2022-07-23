@extends('layouts.dashboard', ['title' => 'Your Workspaces'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Your Workspaces</h1>
  </div>

  <div class="row mb-4 align-items-center">
    <div class="col-lg-6 text-start">
      @if ($msg = Session::get('success'))
      <x-alert>
        @slot('class')
        alert-success
        @endslot
        @slot('msg')
        {!! $msg !!}
        @endslot
      </x-alert>
      @endif
    </div>
    <div class="col-lg-6 text-end">
      <a href="{{ route('space.create') }}" class="btn btn-danger">
        <i class="fas fa-plus-circle me-2"></i>Create new workspace
      </a>
    </div>
  </div>


  <div class="table-responsive">
    <table class="table table-striped text-nowrap" id="myTable">
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
          <td class="text-wrap">{{ $s->desc }}</td>
          <td>
            {{ $s->projects->count() }} - <a href="{{ route('dashboard.space.show', $s->id) }}" class=" link-primary"> View projects </a>
          </td>
          <td>public</td>
          <td>{{ $s->created_at->diffForHumans() }}</td>
          <td>
            <div class="btn-group">
              <a href="{{ route('space', $s->slug) }}?page=dashboard" class="btn btn-dark me-2 rounded">
                <span data-feather="eye"></span>
              </a>
              <a href="{{ route('space.edit', $s->slug) }}?page=dashboard" class="btn btn-primary me-2 rounded">
                <span data-feather="edit"></span>
              </a>
              <form action="{{ route('space.destroy', $s->slug) }}?page=dashboard" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure??')">
                  <span data-feather="trash-2"></span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</main>

@endsection
