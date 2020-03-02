<?php


namespace App\Repository\Eloquent;


use App\Models\TodoList;
use App\Repository\TodoListRepositoryInterface;

class TodoListRepository implements TodoListRepositoryInterface
{

    public function find($id): ?TodoList
    {
        return TodoList::find($id);
    }

    public function get(): array
    {
        return TodoList::get()->toArray();
    }
}
