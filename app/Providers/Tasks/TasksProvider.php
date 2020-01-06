<?php

namespace App\Providers\Tasks;

use App\Model\External\Meisertask\Task\MeisertaskTaskCreateParam;
use App\Model\External\Meisertask\Task\MeisertaskTaskCreateResponse;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\ServiceProvider;
use App\DTO\Tasks\TaskDTO;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class TasksProvider
 * Contains the business logic CRUD operations on @Task
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
        //
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

    /**
     * Service that creates a task in Meistertask and saves it in the database
     *
     * @param $taskDto TaskDTO The task to be created
     * @return TaskDTO
     */
    public function createTask(TaskDto $taskDto): TaskDTO {
        $createdTask = $this->createMeistertaskTask($taskDto);
        $task = $createdTask->toTask();
        $task->save();
    }

    /**
     * Calls Meisertask Apis to create a task
     *
     * @param TaskDTO $taskDTO
     * @return TaskDTO
     */
    private function createMeistertaskTask(TaskDTO $taskDTO): TaskDTO {
        $client = new \GuzzleHttp\Client();
        $meisertaskTask = new MeisertaskTaskCreateParam($taskDTO);
        $url = env("MEISERTASK_API_URL", "") . "1/tasks";
        $response = $client->post($url, ['body' => json_encode($meisertaskTask)]);
        if ($response instanceof MeisertaskTaskCreateResponse) {
            return $response->toTaskDTO();
        }
        throw new BadRequestHttpException($response);
    }

}
