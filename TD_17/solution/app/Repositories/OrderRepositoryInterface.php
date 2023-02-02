<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection;

    public function create(array $data): Order;

    public function updateState(\App\Models\OrderState $orderState): Order;
}
