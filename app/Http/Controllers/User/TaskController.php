<?php

namespace App\Http\Controllers\User;

use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskDeadlineRequest;
use App\Http\Requests\UpdateTaskDescriptionRequest;
use App\Http\Requests\UpdateTaskTitleRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\imp\TaskRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class TaskController extends Controller
{

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(protected TaskRepository $taskRepository)
    {

    }

    /**
     * @param                              $id
     * @param UpdateTaskDescriptionRequest $request
     * @return JsonResponse
     */
    public function updateDescription($id, UpdateTaskDescriptionRequest $request): JsonResponse
    {
        $updateTitle = $this->taskRepository->updateDescription($id, $request->new_description);

        if ($updateTitle) {
            return $this->returnResponseSuccess(new TaskResource($updateTitle), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No task list with that id.'), Response::HTTP_NOT_FOUND);
    }


    /**
     * @param                        $id
     * @param UpdateTaskTitleRequest $request
     * @return JsonResponse
     */
    public function updateTitle($id, UpdateTaskTitleRequest $request): JsonResponse
    {
        $updateTitle = $this->taskRepository->updateTitle($id, $request->new_title);

        if ($updateTitle) {
            return $this->returnResponseSuccess(new TaskResource($updateTitle), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No task list with that id.'), Response::HTTP_NOT_FOUND);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function updateStatus($id): JsonResponse
    {
        $updateStatus = $this->taskRepository->changeTaskStatus($id);

        if ($updateStatus) {
            return $this->returnResponseSuccess(new TaskResource($updateStatus), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('No task list with that id.'), Response::HTTP_NOT_FOUND);
    }

    /**
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskRequest $request)
    {

        $task = $this->taskRepository->createTask($request);

        if ($task) {
            return $this->returnResponseSuccess(new TaskResource($task), null, Response::HTTP_CREATED);
        }

        return $this->returnResponseError(null, __('Something went wrong'), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {

        if ($this->taskRepository->deleteTaskById($id)) {
            return $this->returnResponseSuccess(null, null, Response::HTTP_OK);
        }

        return $this->returnResponseError(null, __('No task list with that id.'), Response::HTTP_NOT_FOUND);
    }
}
