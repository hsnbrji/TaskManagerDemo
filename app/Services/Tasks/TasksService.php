<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Model\External\Meisertask\Task\MeisertaskTaskCreateParam;
use App\Model\External\Meisertask\Task\MeisertaskTaskCreateResponse;
use App\Models\Tasks\Task;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class TasksService
 * Contains the business logic CRUD operations on @Task
 * @package App\Services\Tasks
 */
class TasksService {

    /**
     * Service that creates a task in Meistertask and saves it in the database
     *
     * @param $taskDto TaskDTO The task to be created
     * @return TaskDTO The saved task
     */
    public function createTask(TaskDTO $taskDTO): TaskDTO {
//        $createdTask = $this->createMeistertaskTask($taskDto);
        $task = $taskDTO->toTask();
        $task->save();
        return $taskDTO;
    }

    /**
     * @param string $id Identifier of the task being updated
     * @param TaskDTO $taskDTO The updated task
     * @return TaskDTO The updated task
     */
    public function editTask(string $id, TaskDTO $taskDTO): TaskDTO {
        $taskDTO->id = $id;
        $task = $taskDTO->toTask();
        $task->exists = true;
        $task->save();
        return $taskDTO;
    }

    public function getTasks() {
        $tasksDTOs = array();
        $tasks = Task::all();
        foreach ($tasks as $task) {
            array_push($tasksDTOs, new TaskDTO($task));
        }
        return $tasksDTOs;
    }

    /**
     * Calls Meisertask Apis to create a task
     *
     * @param TaskDTO $taskDTO
     * @return TaskDTO The saved task
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
