<?php

namespace App\Providers\Tasks;

use App\Services\Tasks\TasksService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TasksProvider
 * A provider for tasks service
 * @package App\Providers\Tasks
 */
class TasksProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('TasksService', function () {
            return new TasksService();
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
