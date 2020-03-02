@extends('layout.layout-default')

<link href="{{ asset('css/todo-list/todo-list.css') }}" rel="stylesheet">

@section('main')
    <div class="list-group">
        <a class="list-group-item d-flex justify-content-between align-items-center">
            Cras justo odio
            <span class="badge badge-primary badge-pill">14</span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center">
            Dapibus ac facilisis in
            <span class="badge badge-primary badge-pill">2</span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center">
            Morbi leo risus
            <span class="badge badge-primary badge-pill">1</span>
        </a>
    </div>
@endsection
