<?php

namespace App\Services;

use App\Models\Task;
use App\Repository\Eloquent\TaskRepository;

class TaskService implements TaskServiceInterface
{
    private $taskRepository;

    public function __construct(
        TaskRepository $taskRepository
    )
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAddTaskValidationRules()
    {
        return [
            'new_task_todo_list_id' => 'required|exists:todo_lists,id',
            'new_task_name' => 'required|min:1',
            'new_task_deadline' => 'required|date',
        ];
    }

    public function add($input): Task
    {
        $newTask = new Task();
        $newTask->todo_list_id = $input['new_task_todo_list_id'];
        $newTask->name = $input['new_task_name'];
        $newTask->deadline = $input['new_task_deadline'];
        $newTask->completed = isset($input['new_task_completed']) ? 1 : 0;
        $newTask->disabled = isset($input['new_task_disabled']) ? 1 : 0;

        return $this->taskRepository->add($newTask);
    }

}
