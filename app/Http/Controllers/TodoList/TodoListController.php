<?php

namespace App\Http\Controllers\TodoList;

use App\Http\Controllers\Controller;
use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function todoLists(TodoListService $todoListService)
    {
        $todoLists = $todoListService->get(['with' => ['tasks']]);
        return view('todo-list.todo-lists', ['todoLists' => $todoLists]);
    }

    public function addTodoList(Request $request, TodoListService $todoListService)
    {
        $request->validate([
            'name' => 'required|min:1',
        ]);

        $newTodoList = $todoListService->add($request->input('name'));
        return redirect('/todo-lists/' . $newTodoList->id);
    }

    public function manageTodoList($id, TodoListService $todoListService)
    {
        $todoList = $todoListService->getById($id, ['with' => ['tasks']]);
        if (!$todoList) {
            abort(404);
        }
        $currentTime = strtotime(date('Y-m-d H:i'));

        return view('todo-list.manage-todo-list', ['todoList' => $todoList, 'currentTime' => $currentTime]);
    }

    public function submitManageTodoList($id, Request $request, TodoListService $todoListService)
    {
        $input = $request->all();
        $rules = $todoListService->getManageTodoListValidationRules();
        $request->validate($rules);

        $todoListService->manageTodoList($id, $input);
        return redirect('/todo-lists/' . $id);
    }

    public function delete($id, TodoListService $todoListService)
    {
        $todoListService->delete($id);
        return redirect('/');
    }
}
