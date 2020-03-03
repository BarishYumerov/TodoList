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
        $this->app->singleton(TodoListRepositoryInterface::class, function () {
            return new TodoListRepository();
        });
        $this->app->singleton(TaskRepositoryInterface::class, function () {
            return new TaskRepository();
        });
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
