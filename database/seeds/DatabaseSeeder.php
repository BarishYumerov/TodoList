<?php

use Illuminate\Database\Seeder;
use App\Models\TodoList;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    private $todoListsData = [
        'shopping' => [
            ['name' => 'milk', 'completed' => false],
            ['name' => 'tomatoes', 'completed' => true],
            ['name' => 'potatoes', 'completed' => true]
        ],
        'chores' => [
            ['name' => 'clean the kitchen', 'completed' => true],
            ['name' => 'throw the garbage', 'completed' => false],
            ['name' => 'wash the dishes', 'completed' => true]
        ],
        'work' => [
            ['name' => 'do code review', 'completed' => false],
            ['name' => 'write unit tests', 'completed' => false],
            ['name' => 'discuss database optimizations', 'completed' => true]
        ]
    ];

    public function run()
    {
        $oneWeekDeadline = date('Y-m-d H:i:s', strtotime("+7 day"));
        $noTimeDeadline = date('Y-m-d H:i:s', strtotime("-2 day"));

        foreach ($this->todoListsData as $todoListName => $tasks) {
            $todoList = TodoList::query()->where('name', $todoListName)->first();

            if (!$todoList) {
                $todoList = new TodoList();
                $todoList->name = $todoListName;
                $todoList->completed = false;
                $todoList->save();
            }


            foreach ($tasks as $taskIndex => $taskData) {
                $task = Task::query()->where('todo_list_id', $todoList->id)->where('name', $taskData['name'])->first();

                if (!$task) {
                    $task = new Task();
                    $task->todo_list_id = $todoList->id;
                    $task->name = $taskData['name'];
                    if ($taskIndex % 2 == 0) {
                        $task->deadline = $oneWeekDeadline;
                    } else {
                        $task->deadline = $noTimeDeadline;
                    }
                    $task->completed = false;
                    $task->disabled = false;
                    $task->save();
                }
            }
        }
    }
}
