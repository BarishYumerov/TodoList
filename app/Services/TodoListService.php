<?php

namespace App\Services;

use App\Repository\TodoListRepositoryInterface;
use App\TodoList;

class TodoListService implements TodoListServiceInterface
{
    private $todoListRepository;

    public function __construct(TodoListRepositoryInterface $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    public function getAll(): array {
        return $this->todoListRepository->get();
    }

    public function getById($id): ?TodoList {
        return $this->todoListRepository->find(1);
    }
}
