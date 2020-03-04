<?php

namespace App\Services;

use App\Models\TodoList;

interface TodoListServiceInterface
{
    public function get(): iterable;

    public function getById($id, $settings = []);

    public function add(string $name, bool $completed = false): ?TodoList;

    public function getManageTodoListValidationRules();

    public function manageTodoList($id, $input);

    public function delete($id): bool;
}
