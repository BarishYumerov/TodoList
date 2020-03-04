
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
