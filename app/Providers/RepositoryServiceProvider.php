<?php

namespace App\Providers;

use App\Repository\Eloquent\TaskRepository;
use App\Repository\Eloquent\TodoListRepository;
use App\Repository\TaskRepositoryInterface;
use App\Repository\TodoListRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
