<?php

namespace App\Repositories\imp;


use App\Models\TodoList;
use App\Repositories\BaseRepositoryInterface;

class TodoListRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param TodoList $model
     */
    public function __construct(TodoList $model)
    {
        parent::__construct($model);
    }
}
