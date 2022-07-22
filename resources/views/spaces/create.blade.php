@extends('layouts.main', ['title' => 'Create new workspace'])

@section('content')
<section class="mt-4">
  <h3 class="text-center mb-4">Create your new workspace</h3>
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <form class="border rounded p-4 shadow-sm mb-4" action="{{ route('space.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" name="title" placeholder="Enter new workspace title.." class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter new workspace description here.." id="description">{{ old('description') }}</textarea>
          @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-lg-6">
            <a href="{{ route('dashboard.space') }}" class="btn btn-dark"><i class="fas fa-angle-double-left me-2"></i>Back</a>

          </div>
          <div class="col-lg-6 text-end">
            <button type="submit" class="btn btn-danger"><i class="fas fa-plus-circle me-2"></i>Create</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
