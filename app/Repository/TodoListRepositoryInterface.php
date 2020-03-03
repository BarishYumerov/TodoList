<?php

namespace App\Repository;

use App\Models\TodoList;

interface TodoListRepositoryInterface
{
    public function get($settings = []): iterable;

    public function find($id): ?TodoList;

    public function getById($id, $settings = []);

    public function add(TodoList $todoList): TodoList;

    public function update($id, $updateData): bool;
}
