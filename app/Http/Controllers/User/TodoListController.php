<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Resources\TodoListResource;
use App\Repositories\imp\TodoListRepository;

class TodoListController extends Controller
{

    public function __construct(protected TodoListRepository $todoListRepository)
    {

    }

    public function index(IndexRequest $request)
    {
        $todoLists = $this->todoListRepository->index($request->per_page ?: config('pagination.per_page'));

        if ($todoLists->count() > 0) {
            return $this->returnResponseSuccessWithPagination( TodoListResource::collection($todoLists), null);
        }

        return $this->returnResponseError(null, __('No customers.'), HttpCode::NOT_FOUND);
    }
}
