@extends('layouts.main', ['title' => 'Create new project'])

@section('content')
    <section class="mt-4">
        <h3 class="text-center mb-4">Create your new project</h3>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="border rounded p-4 shadow-sm mb-4" action="{{ route('project.store', $space->slug) }}"
                    method="POST">
                    @csrf

                    <p>Workspace : <span class="fw-bold">{{ $space->title }}</span></p>

                    <div class="mb-3">
                        <label for="projectTitle" class="form-label">Title</label>
                        <input type="text" name="title" placeholder="Enter new project title.."
                            class="form-control @error('title') is-invalid @enderror" id="projectTitle"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category"
                            aria-label="Default select example">
                            <option selected disabled>Select your project category</option>
                            @foreach ($categories as $category)
                                <option @if (old('category') == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Privacy (optional)</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="security" id="security"
                                @if (old('security') == 'on') checked @endif>
                            <label class="form-check-label" for="security">
                                Private project
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route('space', $space->slug) }}" class="text-dark">Back</a>
                        </div>
                        <div class="col-lg-6 text-end">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
