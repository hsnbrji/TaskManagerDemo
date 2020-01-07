<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Model\External\Meisertask\Task\MeisertaskTaskCreateParam;
use App\Model\External\Meisertask\Task\MeisertaskTaskCreateResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TasksService {

    /**
     * Service that creates a task in Meistertask and saves it in the database
     *
     * @param $taskDto TaskDTO The task to be created
     * @return TaskDTO
     */
    public function createTask($taskDto): TaskDTO {
//        $createdTask = $this->createMeistertaskTask($taskDto);
        $task = $taskDto->toTask();
        $task->save();
        $taskDto->id = $task->id;
        return $taskDto;
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
