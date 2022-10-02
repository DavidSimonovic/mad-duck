<?php

namespace App\Repositories\imp;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {

    }

    /**
     * @param int $per_page
     * @return mixed
     */
    public function index(int $per_page): mixed
    {
        return $this->model->orderByDesc('id')->paginate($per_page);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->model->where('id', $id)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->model->where('id', $id)->delete();
    }

}
