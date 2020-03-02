<?php

namespace App\Services;

use App\TodoList;

interface TodoListServiceInterface
{
    public function getAll(): array;
    public function getById($id);
}
