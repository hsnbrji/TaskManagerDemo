<?php
namespace App\DTO\Tasks;

use App\Models\Tasks\Task;
use Carbon\Traits\Date;
use Illuminate\Support\Str;

/**
 * Class TaskDTO
 * Model used to transfer task data to frontend
 *
 * @package App\DTO\Tasks
 */
class TaskDTO {
    public $id;
    public $name;
    public $userId;
    public $due;
    public $notes;
    public $status;
    public $sectionId;
    public $sectionName;

    public function __construct()
    {

    }

    /**
     * Converts Task model to TaskDTO model
     * @param Task $task
     * @return TaskDTO
     */
    public static function fromTask(Task $task): TaskDTO {
        $taskDTO = new self();
        if ($task !== null) {
            $taskDTO->id = $task->id;
            $taskDTO->name = $task->name;
            $taskDTO->userId = $task->user_id;
            $taskDTO->due = $task->due;
            $taskDTO->notes = $task->notes;;
            $taskDTO->status = $task->status;
            $taskDTO->sectionId = $task->section_id;
        }
        return $taskDTO;
    }

    /**
     * Converts TaskDTO model to Task model
     * @return Task
     */
    public function toTask(): Task {
        $task = new Task();
        if ($this->id !== null) {
            $task->id = $this->id;
        } else {
            $uuid = Str::uuid()->toString();
            $task->id = $uuid;
            $this->id = $uuid;
        }
        $task->name = $this->name;
        $task->user_id = $this->userId;
        $task->due = new \DateTime($this->due);
        $task->notes = $this->notes;
        $task->status = $this->status;
        $task->section_id = $this->sectionId;
        return $task;
    }

}
