<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="projectTitle" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Enter project title.." class="form-control @error('title') is-invalid @enderror" id="projectTitle" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" aria-label="Default select example">
              <option selected disabled>Select your project category</option>
              @foreach ($categories as $category)
              <option @if (old('category')==$category->id) selected @endif
                value="{{ $category->id }}">
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
              <input class="form-check-input" type="checkbox" role="switch" name="security" id="security" @if (old('security')=='on' ) checked @endif>
              <label class="form-check-label" for="security">
                Private project
              </label>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
