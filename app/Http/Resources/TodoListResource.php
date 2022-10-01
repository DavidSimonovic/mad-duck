<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'finished_task_count' => count($this->tasks->where('status', 1)),
            'unfinished_task_count' => count($this->tasks->where('status', 0)),
        ];
    }
}
