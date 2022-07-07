@extends('layouts.main', ['title' => 'Register'])

@section('content')
    <section class="my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <h1 class="text-center h3 mb-4 fw-bold">Registration</h1>
                @if ($errors->any())
                    <x-alert>
                        @slot('type')
                            danger
                        @endslot
                        @slot('msg')
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endslot
                    </x-alert>
                @endif
                <form class="row g-3" method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Enter your fullname.." value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="Enter your username.." value="{{ old('username') }}">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter your email address.." value="{{ old('email') }}">
                    </div>
                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Enter your password.." autocomplete="new-password">
                    </div>
                    <div class="col-6">
                        <label for="password_confirm" class="form-label">Password Confirmation</label>
                        <input type="password" name="password_confirm"
                            class="form-control @error('password_confirm') is-invalid @enderror" id="password_confirm"
                            placeholder="Confirm your password..">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger w-100">Register</button>
                    </div>
                </form>
                <p class="small mt-3 text-center">Already registered? <a href="{{ route('login') }}">Login Now!</a>
                </p>
            </div>
        </div>
    </section>
@endsection
