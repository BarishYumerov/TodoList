@extends('layout.layout-default')

<link href="{{ asset('css/todo-list/todo-list.css') }}" rel="stylesheet">

@section('main')
    <div class="todo-list-main">
        <div class="list-group">
            <h3>{{ __('lang.my_todo_lists') }}</h3>
            @foreach($todoLists as $todoList)
                <a href="/todo-lists/{{{$todoList->id}}}"
                   class="list-group-item bg-light d-flex justify-content-between align-items-center {{{$todoList->completed == 1 ? 'completed' : ''}}}">
                    {{{$todoList->name}}} {{{$todoList->completed == 1 ? ' - completed' : ''}}}
                    <span class="badge badge-primary badge-pill">{{{count($todoList->tasks)}}}</span>
                </a>
            @endforeach
        </div>

        <form class="add-todo-list-form" method="post" action="/todo-lists">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('lang.add_new_todo_list') }}</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="New todo list name">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
