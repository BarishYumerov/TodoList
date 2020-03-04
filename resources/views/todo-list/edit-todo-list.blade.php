<h3>
    {{{ __('lang.manage_todo_list') }}}: <b>{{{$todoList->name}}}</b>
    <form id="delete-todo-list-form" action="/todo-lists/{{{$todoList->id}}}/delete" method="post">
        @csrf
        <button id="delete-todo-list" type="submit" data-content="5"
                class="btn btn-danger float-right">{{{__('lang.delete')}}}</button>
    </form>
</h3>
<form class="manage-todo-list__form" method="post" action="/todo-lists/{{{$todoList->id}}}">
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
                @include('todo-list.manage-todo-list-task')
            @endforeach

        </table>
    </div>
    <button type="submit" class="btn btn-primary">{{{__('lang.edit')}}}</button>
</form>
