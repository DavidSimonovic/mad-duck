<?php

namespace App\Repositories\imp;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
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
     * @return Collection
     */
    public function index(int $per_page): Collection
    {
        return $this->model->all()->paginate($per_page);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->model->find($id)->delete();
    }

}
