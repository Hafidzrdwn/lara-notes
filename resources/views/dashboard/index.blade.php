@extends('layouts.main', ['title' => 'Dashboard'])

@section('content')
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
@endsection
