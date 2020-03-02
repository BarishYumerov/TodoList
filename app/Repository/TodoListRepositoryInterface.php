<?php


namespace App\Repository;


use App\Models\TodoList;

interface TodoListRepositoryInterface
{
    public function get(): array;
    public function find($id): ?TodoList;
}
