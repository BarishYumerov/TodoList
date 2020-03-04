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
