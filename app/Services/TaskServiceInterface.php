<?php

namespace App\Services;

use App\Models\Task;

interface TaskServiceInterface
{
    public function add($input): Task;
}
