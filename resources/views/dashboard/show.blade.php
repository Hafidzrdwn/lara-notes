@extends('layouts.dashboard', ['title' => $space->title . ' projects'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">{{ $space->title }} All Projects</h1>
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
      <a href="{{ route('dashboard.space') }}" class="btn btn-dark"><i class="fas fa-angle-double-left me-2"></i>Back</a>
      <a href="{{ route('project.create', $space->slug) }}?page=dashboard" class="btn btn-danger">
        <i class="fas fa-folder-plus"></i> &nbsp;Add new project
      </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped" id="myTable">
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
        @forelse ($projects as $p)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $p->title }}</td>
          <td>{{ $p->category->name }}</td>
          <td class="@if(!$p->security) text-primary @else text-danger @endif">@if($p->security) private @else public @endif</td>
          <td>{{ $p->created_at->diffForHumans() }}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary me-2 rounded btnEdit" data-bs-toggle="modal" data-bs-target="#modalEdit" data-page="dashboard" data-ws="{{ $space->slug }}" data-prj-id="{{ $p->id }}">
                <span data-feather="edit"></span>
              </button>
              <form action="{{ route('project.destroy', [
                                                              'space' => $space->slug,
                                                              'project' => $p->slug,
                                                          ]) }}?page=dashboard" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure??')">
                  <span data-feather="trash-2"></span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">No projects yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>

@include('partials.modalEdit')

@endsection

@section('script')
@if (count($errors) > 0)
<script>
  $(document).ready(function() {
    $('#modalEdit').modal('show');
  });

</script>
@endif
<script src="{{ asset('js/modal-edit.js') }}"></script>
@endsection
