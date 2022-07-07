@extends('layouts.main', ['title' => 'Login'])

@section('content')
    <section class="mt-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <main class="form-signin w-100">
                    <h1 class="h3 mb-4 fw-bold">Login</h1>
                    @if ($msg = Session::get('success'))
                        <x-alert>
                            @slot('type')
                                success
                            @endslot
                            @slot('msg')
                                {!! $msg !!}
                            @endslot
                        </x-alert>
                    @endif
                    @if ($msg = Session::get('error'))
                        <x-alert>
                            @slot('type')
                                danger
                            @endslot
                            @slot('msg')
                                {!! $msg !!}
                            @endslot
                        </x-alert>
                    @endif
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
                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="form-floating">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Password" autocomplete="new-password">
                            <label for="password">Password</label>
                        </div>
                        <div class="mb-3 form-check text-start">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                autocomplete="off">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button class="w-100 mb-3 btn btn-danger" type="submit">Login</button>
                        <small>Not registered yet? <a href="{{ route('register') }}">Register Now!</a></small>
                    </form>
                </main>
            </div>
        </div>
    </section>
@endsection
