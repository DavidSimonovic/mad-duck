<?php

namespace App\Repositories\imp;

use App\Models\Task;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
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

    /**
     * @param $id
     * @return mixed
     */
    public function changeTaskStatus($id)
    {
        $task = $this->model->where('user_id', Auth::id())->where('id', $id);

        $task->status ? $task->status = false : $task->status = true;

        return $task->save();
    }


    /**
     * @param $id
     * @param $newTitle
     * @return mixed
     */
    public function updateTitle($id, $newTitle): mixed
    {
        $todoList = $this->model->where('user_id', Auth::id())->where('id', $id)->first();
        $todoList->title = $newTitle;

        return $todoList->save();
    }

    /**
     * @param $id
     * @param $newDescription
     * @return mixed
     */
    public function updateDescription($id, $newDescription): mixed
    {
        $todoList = $this->model->where('user_id', Auth::id())->where('id', $id)->first();
        $todoList->description = $newDescription;

        return $todoList->save();
    }


    /**
     * @param $id
     * @param $newDeadline
     * @return mixed
     */
    public function updateDeadline($id, $newDeadline): mixed
    {
        $deadline = $this->model->where('user_id', Auth::id())->where('id', $id)->first();
        $deadline->deadline = $newDeadline;

        return $deadline->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTaskListById($id): mixed
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->delete();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function deleteTaskById($id): mixed
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->delete();
    }
}
