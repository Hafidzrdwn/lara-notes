@extends('layouts.main', ['title' => 'Login'])

@section('style')
<style>
  .icon-eye {
    top: 50%;
    transform: translateY(-50%);
    right: 15px;
    font-size: 20px;
    cursor: pointer;
  }

</style>
@endsection

@section('content')
<section class="mt-5 text-center">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-8">
      <main class="form-signin w-100">
        <h1 class="h3 mb-4 fw-bold">Login</h1>
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
        @if ($msg = Session::get('error'))
        <x-alert>
          @slot('class')
          alert-danger
          @endslot
          @slot('msg')
          {!! $msg !!}
          @endslot
        </x-alert>
        @endif
        <div id="alert-zone"></div>
        <form method="POST" action="{{ route('login.store') }}">
          @csrf
          <div class="form-floating">
            <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus>
            <label for="email">Email address</label>
          </div>
          <div class="form-floating position-relative">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="new-password">
            <label for="password">Password</label>
            <i class="icon-eye fas fa-eye position-absolute"></i>
          </div>
          <div class="mb-3 form-check text-start">
            <input type="checkbox" class="form-check-input" name="remember" id="remember" autocomplete="off">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <button class="w-100 mb-3 btn btn-danger login btn-submit-auth" type="submit">Login</button>
          <small>Not registered yet? <a href="{{ route('register') }}">Register Now!</a></small>
        </form>
      </main>
    </div>
  </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/auth.js') }}"></script>
@endsection
