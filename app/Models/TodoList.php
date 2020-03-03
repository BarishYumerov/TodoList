<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todo_lists';

    public function tasks()
    {
        return $this->hasMany('App\Models\Task')->orderBy('id');
    }
}
