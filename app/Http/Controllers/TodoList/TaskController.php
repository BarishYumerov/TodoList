<?php

namespace App\Http\Controllers\TodoList;

use App\Http\Controllers\Controller;
use App\Libs\Printer;
use App\Services\TaskService;
use App\Services\TodoListService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function addTask(Request $request, TaskService $taskService)
    {
        $input = $request->all();
        $rules = $taskService->getAddTaskValidationRules();
        $request->validate($rules);

        $taskService->add($input);
        return redirect('/todo-lists/' . $input['new_task_todo_list_id']);
    }
}
