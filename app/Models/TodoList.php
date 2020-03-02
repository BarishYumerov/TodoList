<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todo_list';
    public $id;
    public $name;
    public $completed;
    public $created_at;
    public $updated_at;
}
