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

    /**
     * Converts TaskDTO model to Task model
     * @return Task
     */
    public function toTask(): Task {
        $task = new Task();
        $task->id = $this->id !== null ? $this->id : Str::uuid();
        $task->name = $this->name;
        $task->user_id = $this->userId;
        $task->due = $this->due;
        $task->notes = $this->notes;
        $task->status = $this->status;
        $task->section_id = $this->sectionId;
        return $task;
    }

}