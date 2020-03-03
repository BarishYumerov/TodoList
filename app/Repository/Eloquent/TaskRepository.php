<?php

namespace App\Repository\Eloquent;

use App\Models\Task;
use App\Repository\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function add(Task $task): Task
    {
        $task->save();
        return $task;
    }

    public function getEditableTasks($todoListId): iterable
    {
        return Task::query()->where('todo_list_id', $todoListId)
            ->where('tasks.deadline', '>', date('Y-m-d H:s:i'))
            ->get();
    }

    public function update($taskId, $updateData): bool
    {
        return Task::query()->where('id', $taskId)->update($updateData);
    }
}
