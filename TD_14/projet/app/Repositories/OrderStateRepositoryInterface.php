<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderStateRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection;

    public function findByCode(string $code);
}
