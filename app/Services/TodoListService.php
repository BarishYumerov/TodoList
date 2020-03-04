<?php

namespace App\Services;

use App\Libs\Printer;
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

    public function getManageTodoListValidationRules()
    {
        return [
            'name' => 'required|min:1',
            'Tasks.*.id' => 'required|exists:tasks,id',
            'Tasks.*.name' => 'required|min:1',
            'Tasks.*.deadline' => 'required|date'
        ];
    }

    public function manageTodoList($id, $input)
    {
        DB::beginTransaction();
        $this->manageEditTasks($id, $input);
        $this->updateTodoList($id, $input);
        DB::commit();
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
            if (!in_array($taskData['id'], $editableTasksIds)) {
                continue;
            }

            $updateTaskData = [
                'name' => $taskData['name'],
                'deadline' => $taskData['deadline'],
                'disabled' => isset($taskData['disabled']) ? true : false
            ];

            if ($this->checkIfTaskIsCompletable($taskData['id'], $editableTasks)) {
                if(isset($taskData['completed'])) {
                    $updateTaskData['completed'] = true;
                } else {
                    $updateTaskData['completed'] = false;
                }
            }

            $this->taskRepository->update($taskData['id'], $updateTaskData);
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
            if ($editableTask->id == $taskId && !$editableTask->disabled) {
                return true;
            }
        }

        return false;
    }
}
