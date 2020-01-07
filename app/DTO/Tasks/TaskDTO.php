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

    public function __construct(?Task $task)
    {
        if ($task !== null) {
            $this->id = $task->id;
            $this->name = $task->name;
            $this->userId = $task->user_id;
            $this->due = $task->due;
            $this->notes = $task->notes;
            $this->status = $task->status;
            $this->sectionId = $task->section_id;
        }
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
        $task->due = $this->due;
        $task->notes = $this->notes;
        $task->status = $this->status;
        $task->section_id = $this->sectionId;
        return $task;
    }

}
