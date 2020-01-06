<?php

namespace App\Model\External\Meisertask\Task;

use App\DTO\Tasks\TaskDTO;

/**
 * Class MeisertaskTaskCreateResponse
 * Contains the properties of the Task Create Response that Meisertask APIs provide
 * @package App\Model\External\Meisertask\Task
 */
class MeisertaskTaskCreateResponse
{
    public $id;
    public $token;
    public $name;
    public $notes;
    public $status;
    public $status_updated_at;
    public $section_id;
    public $section_name;
    public $project_id;
    public $sequence;
    public $assigned_to_id;
    public $tracked_time;
    public $due;
    public $created_at;
    public $updated_at;

    /**
     * Converts the instance of MeisertaskCreateTaskResponse to TaskDTO instance
     *
     * @return TaskDTO
     */
    public function toTaskDTO(): TaskDTO {
        $taskDTO = new TaskDTO();
        $taskDTO->id = $this->id;
        $taskDTO->name = $this->name;
        $taskDTO->userId = $this->assigned_to_id;
        $taskDTO->notes = $this->notes;
        $taskDTO->sectionName = $this->section_name;
        $taskDTO->sectionId = $this->section_id;
        $taskDTO->due = $this->due;
        $taskDTO->status = $this->status;
        return $taskDTO;
    }

}
