@extends('layout.layout-default')

<link href="{{ asset('css/todo-list/manage-todo-list.css') }}" rel="stylesheet">
@section('main')
    <div class="manage-todo-list-main">
        <form class="manage-todo-list__form" method="post" action="/todo-lists/{{{$todoList->id}}}">
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
                    @foreach($todoList->tasks as $taskIndex => $task)
                        <tr id="task-row-{{$task->id}}">
                            <td>{{{$taskIndex + 1}}}</td>
                            <td>
                                <input type="hidden" name="Tasks[{{{$task->id}}}][id]" value="{{{$task->id}}}">
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

                </table>
            </div>
            <button type="submit" class="btn btn-primary">{{{__('lang.edit')}}}</button>
        </form>
        <form class="manage-todo-list__form" method="post" action="/tasks">
            <h3>{{{__('lang.add_new_task')}}}</h3>
            @csrf
            <table class="table">
                <tr>
                    <th scope="col">{{{__('lang.name')}}}</th>
                    <th scope="col">{{{__('lang.deadline')}}}</th>
                    <th scope="col" class="small-td center">{{{__('lang.completed')}}}</th>
                    <th scope="col" class="small-td center">{{{__('lang.disabled')}}}</th>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="new_task_todo_list_id" value="{{{$todoList->id}}}">
                        <input type="text" name="new_task_name" placeholder="{{{__('name')}}}"
                               value="{{{ old('new_task_name') }}}">
                        @error('new_task_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="datetime-local" name="new_task_deadline" value="{{{ old('new_task_deadline') }}}">
                        @error('new_task_deadline')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td class="small-td center"><input type="checkbox" name="new_task_completed"></td>
                    <td class="small-td center"><input type="checkbox" name="new_task_disabled"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">{{{__('lang.add')}}}</button>
        </form>
    </div>
@endsection
