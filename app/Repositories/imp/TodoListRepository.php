<?php

namespace App\Repositories\imp;


use App\Models\TodoList;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class TodoListRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param TodoList $model
     */
    public function __construct(TodoList $model)
    {
        parent::__construct($model);
    }


    /**
     * @param $request
     * @param $per_page
     * @return mixed
     */
    public function filterTodoLists($request, $per_page): mixed
    {
        $data = $this->model->where('user_id', Auth::id())->orderByDesc('id')->paginate($per_page);

        if ($request) {
            $data = $this->model->where('user_id', Auth::id())->filter($request)->paginate($per_page);
        }
        return $data;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function singleTodoListById($id): mixed
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->first();
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
     * @return mixed
     */
    public function deleteTodoListById($id): mixed
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->delete();
    }


    /**
     * @param $request
     * @return mixed
     */
    public function createTodoList($request)
    {
        return $this->model->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
    }
}
