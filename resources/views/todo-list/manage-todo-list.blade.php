@extends('layout.layout-default')

<link href="{{ asset('css/todo-list/manage-todo-list.css') }}" rel="stylesheet">
@section('main')
    <div class="manage-todo-list-main">
        <form class="add-todo-list-form" method="post" action="/todo-lists/{{{$todoList->id}}}">
            <h3>{{{ __('lang.manage_todo_list') }}}: <b>{{{$todoList->name}}}</b></h3>
            @csrf
            <div class="form-group">
                <label for="name">{{ __('lang.name') }}</label>
                <input type="text" class="form-control" name="name" id="name" value="{{{$todoList->name}}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="list-group">
                <h3>{{{__('lang.tasks') }}}:</h3>
                <table class="table">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{{__('lang.name')}}}</th>
                        <th scope="col">{{{__('lang.deadline')}}}</th>
                        <th scope="col" class="small-td center">{{{__('lang.completed')}}}</th>
                        <th scope="col" class="small-td center">{{{__('lang.disabled')}}}</th>
                    </tr>
                    @foreach($todoList['tasks'] as $taskIndex => $task)
                        <tr id="task-row-{{$task->id}}">
                            <td>{{{$task->id}}}</td>
                            <td>
                                <input type="text" name="Tasks[{{{$task->id}}}][name]" value="{{{$task->name}}}">
                                @error('Tasks.' . $task->id . '.name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="datetime-local" name="Tasks[{{{$task->id}}}][deadline]"
                                       value="{{date('Y-m-d\TH:i', strtotime($task->deadline))}}">
                                @error('Tasks.' . $task->id . '.deadline')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td class="small-td center"><input type="checkbox" name="Tasks[{{{$task->id}}}][completed]"
                                                               @if($task->completed == 1) checked @endif></td>
                            <td class="small-td center"><input type="checkbox" name="Tasks[{{{$task->id}}}][disabled]"
                                                               @if($task->disabled == 1) checked @endif></td>
                        </tr>
                    @endforeach
                    <tr id="task-row-{{$task->id}}">
                        <td>New Task</td>
                        <td>
                            <input type="text" name="NewTask[name]" placeholder="{{{__('lang.name')}}}"
                                   value="{{ old('NewTask.name') }}">
                            @error('NewTask.name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="datetime-local" name="NewTask[deadline]">
                            @error('NewTask.deadline')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td class="small-td center"><input type="checkbox" name="NewTask[completed]"></td>
                        <td class="small-td center"><input type="checkbox" name="NewTask[disabled]"></td>
                    </tr>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
