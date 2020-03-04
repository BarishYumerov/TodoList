<?php

namespace App\Providers;

use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use App\Services\TodoListService;
use App\Services\TodoListServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TodoListServiceInterface::class, function () { return new TodoListService(); });
        $this->app->singleton(TaskServiceInterface::class, function () { return new TaskService(); });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
