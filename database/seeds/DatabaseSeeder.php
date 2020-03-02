<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_list')->insert([ 'name' => 'shopping', 'completed' => false ]);
        DB::table('todo_list')->insert([ 'name' => 'chores', 'completed' => false ]);
        DB::table('todo_list')->insert([ 'name' => 'work', 'completed' => false ]);

        $oneWeekDeadlineTime = strtotime("+7 day");

        $oneWeekDeadline = date('Y-m-d H:i:s', $oneWeekDeadlineTime);
        $noTimeDeadline = date('Y-m-d H:i:s');

        DB::table('tasks')->insert([ 'todo_list_id' => 1, 'name' => 'milk', 'deadline' => $noTimeDeadline, 'completed' => false ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 1, 'name' => 'tomatoes', 'deadline' => $noTimeDeadline, 'completed' => true ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 1, 'name' => 'potatoes', 'deadline' => $oneWeekDeadline, 'completed' => true ]);

        DB::table('tasks')->insert([ 'todo_list_id' => 2, 'name' => 'clean the kitchen', 'deadline' => $oneWeekDeadline, 'completed' => true ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 2, 'name' => 'throw the garbage', 'deadline' => $noTimeDeadline, 'completed' => false ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 2, 'name' => 'wash the dishes', 'deadline' => $oneWeekDeadline, 'completed' => true ]);

        DB::table('tasks')->insert([ 'todo_list_id' => 3, 'name' => 'do code review', 'deadline' => $oneWeekDeadline, 'completed' => false ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 3, 'name' => 'write unit tests', 'deadline' => $oneWeekDeadline, 'completed' => false ]);
        DB::table('tasks')->insert([ 'todo_list_id' => 3, 'name' => 'discuss database optimizations', 'deadline' => $noTimeDeadline, 'completed' => true ]);
    }
}
