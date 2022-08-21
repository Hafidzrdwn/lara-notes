@extends('layouts.main', ['title' => 'My Profile'])

@section('style')
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<style>
  .user-attr:hover {
    text-decoration: underline !important;
    color: #3459e6 !important;
  }

  .user-social {
    transition: .4s;
  }

  .user-social:hover {
    transform: translateY(-10px);
  }

  .preview {
    overflow: hidden;
    width: 200px;
    height: 200px;
    border: 1.5px solid black;
    border-radius: 50%;
  }

  .cropper-view-box {
    box-shadow: 0 0 0 1px #39f;
    border-radius: 50%;
    outline: 0;
  }

  .cropper-face {
    background-color: inherit !important;
  }

  .cropper-view-box {
    outline: inherit !important;
  }

  .text-change:hover {
    text-decoration: underline !important;
  }

</style>
@endsection

@section('content')
<section class="mt-5 pt-5 pb-4">
  <div class="row align-items-start justify-content-center">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body text-center position-relative">
          <img src="@if($user->profile_image) {{ asset('storage/' . $user->profile_image) }} @else {{ asset('images/default.jpg') }} @endif" width="140" class="img-fluid rounded-circle position-absolute border border-dark start-50 translate-middle" id="user-profile" alt="photo profile">
          @if ($user->username == auth()->user()->username)
          <div class="dropdown-center">
            <p style="margin-top: 78px; cursor: pointer;" class="text-primary text-change" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Change profile photo</p>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li>
                <form method="post">
                  <label class="dropdown-item" style="cursor: pointer;" for="profile_image">
                    <i class="fas fa-upload me-2"></i>New profile photo
                    <input type="file" name="profile_image" class="image d-none" id="profile_image" />
                  </label>
                </form>
              </li>
              @if ($user->profile_image)
              <li>
                <form action="{{ route('user.profile.destroy') }}" method="POST">
                  @method('delete')
                  @csrf
                  <button type="submit" class="dropdown-item dropdown-item-danger text-danger" onclick="return confirm('Are you sure to delete your profile??')">
                    <i class="fas fa-trash-alt me-2"></i>Remove profile photo
                  </button>
                </form>
              </li>
              @endif
            </ul>
          </div>
          @endif
          <h3>{{ $user->name }}</h3>
          <p class="text-muted">{{ '@' . $user->username }}</p>
          <div class="d-flex justify-content-around align-items-center my-4">
            <div>
              <h5 class="fw-bold">{{ $user->spaces->count() }}</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Workspaces</a>
            </div>
            <div>
              <h5 class="fw-bold">1</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Followers</a>
            </div>
            <div>
              <h5 class="fw-bold">1</h5>
              <a href="" class="user-attr text-decoration-none text-dark">Following</a>
            </div>
          </div>
          @if ($user->bio)
          <p>{{ $user->bio }}</p>
          @endif
          <div class="d-flex align-items-center justify-content-center gap-5 mt-4 @if($user->social) mb-5 @else mb-4 @endif">
            @php
            $icon = ['fa-instagram', 'fa-twitter', 'fa-github'];
            $link = ['https://www.instagram.com/', 'https://twitter.com/', 'https://github.com/'];
            @endphp
            @if ($user->social && $user->attr)
            @foreach ($user->attr as $key => $item)
            @if ($item != 'null')
            <a href="{{ $link[$key] . $item }}" class="text-dark user-social" target="_blank">
              <i class="fab {{ $icon[$key] }} fs-4"></i>
            </a>
            @endif
            @endforeach
            @endif
          </div>
          <span class="text-primary small"><i class="fas fa-calendar-alt me-2"></i>Join {{ $user->created_at->diffForHumans() }}</span>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h2 class="text-center mt-2 mb-4">Edit Profile</h2>
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
          <form action="{{ route('user.update', [
            'user' => $user->username
          ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row g-3 mb-3">
              <div class="col">
                <label for="email" class="form-label">Email address</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="Enter your email address" value="{{ $user->email }}" readonly>
              </div>
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" value="{{ $user->name }}" readonly>
              </div>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" id="username" placeholder="Enter your username" value="{{ old('username', $user->username) }}">
              @error('username')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="bio">Bio</label>
              <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror" placeholder="Enter your bio here..">{{ old('bio', $user->bio) }}</textarea>
              @error('bio')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="social">Social media</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="social" name="social" autocomplete="off" @if($user->social && substr_count($user->social, "null") < 3) checked @endif>
                  <label class="form-check-label social-label" for="social">Disabled</label>
              </div>
              <div class="row row-social d-none g-3 mt-1 mb-3">
                <div class="col">
                  <label for="social_ig" class="form-label">Instagram</label>
                  <input type="text" id="social_ig" class="form-control" name="social_attr[0]" placeholder="Enter your instagram username" value="@if($user->attr && $user->attr[0] != 'null'){{ $user->attr[0] }}@endif">
                </div>
                <div class="col">
                  <label for="social_twt" class="form-label">Twitter</label>
                  <input type="text" id="social_twt" name="social_attr[1]" class="form-control" placeholder="Enter your twitter username" value="@if($user->attr && $user->attr[1] != 'null'){{ $user->attr[1] }}@endif">
                </div>
                <div class="col">
                  <label for="social_gt" class="form-label">Github</label>
                  <input type="text" id="social_gt" name="social_attr[2]" class="form-control" placeholder="Enter your github username" value="@if($user->attr && $user->attr[2] != 'null'){{ $user->attr[2] }}@endif">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-block ms-auto mt-4">Edit profile</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


{{-- Modal --}}
<div class="modal fade" id="cropProfilePhoto" tabindex="-1" aria-labelledby="cropProfilePhotoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cropProfilePhotoLabel">Crop image before upload</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row align-items-center justify-content-around">
            <div class="col-md-7">
              <img src="" class="w-100" id="sample_image" />
            </div>
            <div class="col-md-4">
              <div class="preview"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="https://unpkg.com/cropperjs"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
