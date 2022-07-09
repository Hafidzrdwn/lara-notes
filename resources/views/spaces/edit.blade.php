@extends('layouts.main', ['title' => 'Edit workspace'])

@section('content')
    <section class="mt-4">
        <h3 class="text-center mb-4">Edit your workspace</h3>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="border rounded p-4 shadow-sm mb-4" action="{{ route('space.update', $space->slug) }}"
                    method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" placeholder="Enter workspace title.."
                            class="form-control @error('title') is-invalid @enderror" id="title"
                            value="{{ old('title', $space->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" placeholder="Workspace slug will show here.."
                            class="form-control" id="slug" value="{{ old('slug', $space->slug) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter workspace description here.." id="description">{{ old('description', $space->desc) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route('spaces') }}" class="text-dark">Back</a>
                        </div>
                        <div class="col-lg-6 text-end">
                            <button type="submit" class="btn btn-danger">Edit workspace</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
