<?php

namespace App\Http\Controllers\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Http\Controllers\Controller;
use App\Providers\Tasks\TasksProvider;
use Illuminate\Http\Request;

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

    protected TasksProvider $tasksProvider;

    /**
     * Create a new controller instance.
     *
     * @param TasksProvider $tasksProvider
     */
    public function __construct(TasksProvider $tasksProvider)
    {
        $this->$tasksProvider = $tasksProvider;
    }

    /**
     * @param Request $request
     * @return TaskDTO the created task
     */
    public function createTask(Request $request): TaskDTO {
        $taskDTO = json_decode($request);
        return $this->tasksProvider->createTask($taskDTO);
    }

}
