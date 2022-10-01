<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\UpdateTodoListTitleRequest;
use App\Http\Resources\SingleTodoListResource;
use App\Http\Resources\TodoListResource;
use App\Repositories\imp\TodoListRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class TodoListController extends Controller
{

    /**
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(protected TodoListRepository $todoListRepository)
    {

    }

    /**
     * @param IndexRequest $request
     * @return JsonResponse|mixed
     */
    public function index(IndexRequest $request)
    {
        $todoLists = $this->todoListRepository->filterTodoLists($request,$request->per_page ?: config('pagination.per_page'));

        if ($todoLists->count() > 0) {
            return $this->returnResponseSuccessWithPagination(TodoListResource::collection($todoLists), null);
        }

        return $this->returnResponseError(null, __('No customers.'), HttpCode::NOT_FOUND);
    }

    public function create()
    {

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $todoList = $this->todoListRepository->singleTodoListById($id);

        if ($todoList) {
            return $this->returnResponseSuccess(new SingleTodoListResource($todoList), null, HttpCode::SUCCESS);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), HttpCode::NOT_FOUND);
    }

    /**
     * @param                            $id
     * @param UpdateTodoListTitleRequest $request
     * @return JsonResponse
     */
    public function updateTitle($id, UpdateTodoListTitleRequest $request)
    {
        $updateTitle = $this->todoListRepository->updateTitle($id, $request->new_title);

        if ($updateTitle) {
            return $this->returnResponseSuccess(new SingleTodoListResource($updateTitle), null, HttpCode::SUCCESS);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), HttpCode::NOT_FOUND);


    }
}
