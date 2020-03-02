<?php

namespace App\Http\Controllers\TodoList;

use App\Http\Controllers\Controller;
use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function todoLists(TodoListService $todoListService) {
        $todoLists = $todoListService->getAll();
        return view('todo-list.todo-list', []);
    }
}
