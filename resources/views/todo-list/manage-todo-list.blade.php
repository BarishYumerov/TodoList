@extends('layout.layout-default')

<link href="{{ asset('css/todo-list/manage-todo-list.css') }}" rel="stylesheet">
@section('main')
    <div class="manage-todo-list-main">
        {{$currentTime = strtotime(date('Y-m-d H:i'))}}}
        @include('todo-list.edit-todo-list')
        @include('todo-list.add-new-task-form')
    </div>
@endsection
