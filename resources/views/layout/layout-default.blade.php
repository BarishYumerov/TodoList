@extends('layout.master')

@section('layout')

    @include('layout.header-default')
    <div id="main">
        @yield('main')
    </div>
@endsection
