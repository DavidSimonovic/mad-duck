<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTodoListRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\UpdateTodoListDescriptionRequest;
use App\Http\Requests\UpdateTodoListTitleRequest;
use App\Http\Resources\TodoListResource;
use App\Repositories\imp\TodoListRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
    public function index(IndexRequest $request): mixed
    {
        $todoLists = $this->todoListRepository->filterTodoLists($request, $request->per_page ?: config('pagination.per_page'));

        if ($todoLists->count() > 0) {
            return $this->returnResponseSuccessWithPagination(TodoListResource::collection($todoLists), null);
        }

        return $this->returnResponseError(null, __('No customers.'), Response::HTTP_NOT_FOUND);
    }


    /**
     * @param CreateTodoListRequest $request
     * @return JsonResponse
     */
    public function store(CreateTodoListRequest $request): JsonResponse
    {
        $todoList = $this->todoListRepository->createTodoList($request);

        if ($todoList) {
            return $this->returnResponseSuccess(new TodoListResource($todoList), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $todoList = $this->todoListRepository->singleTodoListById($id);

        if ($todoList) {
            return $this->returnResponseSuccess(new TodoListResource($todoList), null, Response::HTTP_OK);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), Response::HTTP_NOT_FOUND);
    }

    /**
     * @param                            $id
     * @param UpdateTodoListTitleRequest $request
     * @return JsonResponse
     */
    public function updateTitle($id, UpdateTodoListTitleRequest $request): JsonResponse
    {
        $updateTitle = $this->todoListRepository->updateTitle($id, $request->new_title);

        if ($updateTitle) {
            return $this->returnResponseSuccess(new TodoListResource($updateTitle), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), Response::HTTP_NOT_FOUND);

    }

    /**
     * @param                                  $id
     * @param UpdateTodoListDescriptionRequest $request
     * @return JsonResponse
     */
    public function updateDescription($id, UpdateTodoListDescriptionRequest $request): JsonResponse
    {
        $updateTitle = $this->todoListRepository->updateDescription($id, $request->new_description);

        if ($updateTitle) {
            return $this->returnResponseSuccess(new TodoListResource($updateTitle), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No todo list with that id.'), Response::HTTP_NOT_FOUND);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {

        if ($this->todoListRepository->deleteTodoListById($id)) {
            return $this->returnResponseSuccess(null, null, Response::HTTP_OK);
        }

        return $this->returnResponseError(null, __('No Todo list with that id.'), Response::HTTP_NOT_FOUND);
    }
}
