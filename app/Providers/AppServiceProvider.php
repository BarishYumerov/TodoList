<?php

namespace App\Providers;

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
        $this->app->singleton(TodoListServiceInterface::class, function ($app) {
            return new TodoListService($app);
        });
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