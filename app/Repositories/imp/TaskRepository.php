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

        $task = $this->model->where('user_id', Auth::id())->where('id', $id)->first();

        $task->status ? $task->status = false : $task->status = true;

        $task->save();

        return $task;
    }


    /**
     * @param $id
     * @param $newTitle
     * @return mixed
     */
    public function updateTitle($id, $newTitle): mixed
    {
        $task = $this->model->where('user_id', Auth::id())->where('id', $id)->first();
        $task->task_title = $newTitle;
        $task->save();

        return $task;
    }

    /**
     * @param $id
     * @param $newDescription
     * @return mixed
     */
    public function updateDescription($id, $newDescription): mixed
    {
        $task = $this->model->where('user_id', Auth::id())->where('id', $id)->first();
        $task->task_description = $newDescription;
        $task->save();

        return $task;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createTask($request)
    {
        return Task::create([
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'user_id' => Auth::id(),
            'todo_list_id' => $request->todo_list_id,
            'deadline' => $request->deadline,
        ]);
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
