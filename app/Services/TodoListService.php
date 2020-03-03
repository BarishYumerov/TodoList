<?php

namespace App\Services;

use App\Libs\Printer;
use App\Models\Task;
use App\Repository\Eloquent\TaskRepository;
use App\Repository\TodoListRepositoryInterface;
use App\Models\TodoList;
use Illuminate\Support\Facades\DB;

class TodoListService implements TodoListServiceInterface
{
    private $todoListRepository;
    private $taskRepository;

    public function __construct(
        TodoListRepositoryInterface $todoListRepository,
        TaskRepository $taskRepository
    )
    {
        $this->todoListRepository = $todoListRepository;
        $this->taskRepository = $taskRepository;
    }

    public function get($settings = []): iterable
    {
        return $this->todoListRepository->get($settings);
    }

    public function getById($id, $settings = [])
    {
        return $this->todoListRepository->getById($id, $settings);
    }

    public function add(string $name, bool $completed = false): ?TodoList
    {
        $todoList = new TodoList();
        $todoList->name = $name;
        $todoList->completed = $completed;
        return $this->todoListRepository->add($todoList);
    }

    public function getManageTodoListValidationRules($input)
    {
        $rules = [
            'name' => 'required|min:1',
            'Tasks.*.name' => 'required|min:1',
            'Tasks.*.deadline' => 'required|date'
        ];

        if ($this->checkIfAddingNewTask($input)) {
            $rules['NewTask.name'] = 'required|min:1';
            $rules['NewTask.deadline'] = 'required|date';
        }

        return $rules;
    }

    private function checkIfAddingNewTask($input): bool
    {
        if (
            (isset($input['NewTask']) && isset($input['NewTask']['name']) && !empty($input['NewTask']['name'])) ||
            (isset($input['NewTask']['deadline']) && !empty($input['NewTask']['deadline']))
        ) {
            return true;
        }

        return false;
    }

    public function manageTodoList($id, $input)
    {
        DB::beginTransaction();
        $this->manageNewTask($id, $input);
        $this->manageEditTasks($id, $input);
        $this->updateTodoList($id, $input);
        DB::commit();
    }

    private function manageNewTask($id, $input): ?Task
    {
        if ($this->checkIfAddingNewTask($input)) {
            $newTask = new Task();
            $newTask->todo_list_id = $id;
            $newTask->name = $input['NewTask']['name'];
            $newTask->deadline = $input['NewTask']['deadline'];
            $newTask->completed = isset($input['NewTask']['completed']) ? 1 : 0;
            $newTask->disabled = isset($input['NewTask']['disabled']) ? 1 : 0;

            return $this->taskRepository->add($newTask);
        }

        return null;
    }

    private function updateTodoList($id, $input)
    {
        $updateDta = [
            'name' => $input['name']
        ];

        return $this->todoListRepository->update($id, $updateDta);
    }

    private function manageEditTasks($id, $input)
    {
        $editableTasks = $this->taskRepository->getEditableTasks($id);
        $this->editTasks($id, $input, $editableTasks);
    }

    private function editTasks($id, $input, $editableTasks)
    {
        if (!isset($input['Tasks'])) {
            return;
        }

        $editableTasksIds = $this->getEditableTasksIds($editableTasks);

        foreach ($input['Tasks'] as $taskId => $taskData) {
            if (!in_array($taskId, $editableTasksIds)) {
                continue;
            }

            $updateTaskData = [
                'name' => $taskData['name'],
                'deadline' => $taskData['deadline'],
                'disabled' => isset($taskData['disabled']) ? true : false
            ];

            if ($this->checkIfTaskIsCompletable($taskId, $editableTasks)) {
                if(isset($taskData['completed'])) {
                    $updateTaskData['completed'] = true;
                } else {
                    $updateTaskData['completed'] = false;
                }
            }

            $this->taskRepository->update($taskId, $updateTaskData);
        }
    }

    private function getEditableTasksIds($editableTasks)
    {
        $editableTasksIds = [];
        foreach ($editableTasks as $editableTask) {
            $editableTasksIds[] = $editableTask->id;
        }
        return $editableTasksIds;
    }

    private function checkIfTaskIsCompletable($taskId, $editableTasks): bool
    {
        foreach ($editableTasks as $editableTask) {
            if ($editableTask->id === $taskId && !$editableTask->disabled) {
                return true;
            }
        }

        return false;
    }
}
