<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'task_title' => $this->task_title,
            'task_description' => $this->task_description,
            'status' => $this->status,
            'deadline' => Carbon::createFromFormat('Y-m-d H:i:s', $this->deadline, config('app.timezone')),
            'user_id' => $this->user_id,
        ];
    }
}
