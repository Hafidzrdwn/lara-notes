@extends('layouts.main', ['title' => 'Home'])

@section('content')
    <section class="mt-5 pt-5">
        <div class="row justify-content-around align-items-center">
            <div class="col-lg-5">
                <h1 class="fw-bold heading-hero text-danger text-decoration-underline">LaraNotes</h1>
                <p>LaraNotes, A Free Online Notes In One Delightful App. Get Started For Free. Plan
                    Your Day,
                    Manage Projects, Capture Notes And Brainstorm New Ideas. All In One App. </p>
                <a href="{{ route('spaces') }}" class="btn btn-dark me-1"><i class="fas fa-pencil-alt me-1"></i> Get
                    Started</a>
                <a href="" class="btn btn-outline-secondary">Feature</a>
                <p class="mt-3 small">Made with &#10084; by <a class="text-danger"
                        href="https://www.instagram.com/hafidzrdwn/" target="_blank">@hafidzrdwn</a></p>
            </div>
            <div class="col-lg-5">
                <img class="w-100" src="{{ asset('images/hero.svg') }}" alt="">
            </div>
        </div>
    </section>
@endsection
