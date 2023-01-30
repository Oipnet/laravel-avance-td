<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
