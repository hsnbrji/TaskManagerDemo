<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * Model for Database Task
 *
 * @package App\Models\Tasks
 */
class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $keyType = 'uuid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'due', 'notes', 'status', 'section_id'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due' => 'datetime',
    ];
}
