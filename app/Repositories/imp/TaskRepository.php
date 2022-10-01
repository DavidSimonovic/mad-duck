<?php

namespace App\Repositories\imp;

use App\Models\Task;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $per_page
     * @return mixed
     */
    public function tasksByAuthUserWithPagination($per_page): mixed
    {
        return $this->model->where('user_id', Auth::id())->orderByDesc('id')->paginate($per_page);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function singleTaskById($id): mixed
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->first();
    }

    public function changeTaskStatus($id)
    {
        $task = $this->model->where('user_id', Auth::id())->where('id', $id);

        $task->status ? $task->status = false : $task->status = true;

        return $task->save();
    }
}
