<?php

namespace App\Http\Controllers\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Http\Controllers\Controller;
use App\Providers\Tasks\TasksProvider;
use App\Services\Tasks\TasksService;
use Illuminate\Http\Request;
use Karriere\JsonDecoder\JsonDecoder;

/**
 * Class TasksController
 * Controller for operations on Task entity
 *
 * @package App\Http\Controllers\Tasks
 */
class TasksController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Tasks Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles creating and editing tasks
   |
   */

    protected TasksService $tasksService;

    /**
     * Create a new controller instance.
     *
     * @param TasksService $tasksService
     */
    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    /**
     * @param Request $request
     * @return string json string of the created task
     */
    public function createTask(Request $request): string {
        $jsonDecoder = new JsonDecoder();
        $taskDTO = $jsonDecoder->decode($request->getContent(), TaskDTO::class);
        return json_encode($this->tasksService->createTask($taskDTO));
    }

    /**
     * @param Request $request
     * @param $id string The id of the task to be edited
     * @return string json string of the edited task
     */
    public function editTask(Request $request, $id): string {
        $jsonDecoder = new JsonDecoder();
        $taskDTO = $jsonDecoder->decode($request->getContent(), TaskDTO::class);
        return json_encode($this->tasksService->editTask($id, $taskDTO));
    }

    /**
     * @param Request $request
     * @return string json string of all tasks
     */
    public function getTasks(Request $request): string {
        return json_encode($this->tasksService->getTasks());
    }

    /**
     * @param Request $request
     * @param $id string Id of the task
     * @return string json string of all tasks
     */
    public function getTaskDetails(Request $request, $id): string {
        return json_encode($this->tasksService->getTaskDetails($id));
    }

}
