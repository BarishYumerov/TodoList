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

    public function get($settings = []): iterable
    {
        $query = TodoList::query()
            ->orderBy('name');

        if (isset($settings['with'])) {
            $query->with($settings['with']);
        }

        return $query->get();
    }

    public function getById($id, $settings = [])
    {
        $query = TodoList::query()->where('id', $id);

        if (isset($settings['with'])) {
            $query->with($settings['with']);
        }

        return $query->first();
    }

    public function add(TodoList $todoList): TodoList
    {
        $todoList->save();
        return $todoList;
    }

    public function update($id, $updateData): bool
    {
        return TodoList::query()->where('id', $id)->update($updateData);
    }

    public function delete($id): bool
    {
        return TodoList::query()->where('id', $id)->delete();
    }
}
