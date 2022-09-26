<?php

namespace App\Repositories\imp;

use App\Models\Task;
use App\Repositories\BaseRepositoryInterface;

class TaskRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }
}
