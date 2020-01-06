<?php

namespace App\Model\External\Meisertask\Task;

use App\DTO\Tasks\TaskDTO;

/**
 * Class MeisertaskTaskCreateParam
 * Contains the properties of the Task Create that Meisertask APIs provide
 * @package App\Model\External\Meisertask\Task
 */
class MeisertaskTaskCreateParam {
    private $section_id;
    private $name;
    private $assigned_to_id;
    private $due;
    private $notes;
    private $status;
    private $label_ids;
    private $custom_fields;
    private $checklists;

    /**
     * MeisertaskTaskCreateParam constructor.
     * Creates instance of MeisertaskTaskCreateParam mapped from TaskDTO
     * @param TaskDTO $taskDTO
     */
    public function __construct(TaskDTO $taskDTO)
    {
        $this->section_id = $taskDTO->sectionId;
        $this->name = $taskDTO->name;
        $this->assigned_to_id = $taskDTO->userId;
        $this->due = $taskDTO->due;
        $this->notes = $taskDTO->notes;
        $this->status = $taskDTO->status;
    }

    /**
     * Maps the instance of MeisertaskTaskCreateParam to an instance TaskDTO
     *
     * @return TaskDTO
     */
    public function toTaskDto(): TaskDTO {
        $taskDTO = new TaskDTO();
        $taskDTO->sectionId = $this->section_id;
        $taskDTO->name = $this->name;
        $taskDTO->userId = $this->assigned_to_id;
        $taskDTO->due = $this->due;
        $taskDTO->notes = $this->notes;
        $taskDTO->status = $this->status;
    }

}
