<?php

namespace App\Repository;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function add(Task $task): Task;

    public function getEditableTasks($todoListId): iterable;
}
