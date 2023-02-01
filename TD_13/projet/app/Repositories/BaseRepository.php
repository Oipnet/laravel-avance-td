<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository
{
    public function __construct(
        protected Model $model
    ) {
    }

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection
    {
        return $paginate ? $this->model->with($with)->paginate() : $this->model->with($with)->get();
    }
}
