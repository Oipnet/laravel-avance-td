<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
    public function setModel(Model $model);
    public function getAll(): Collection;
    public function create(array $data): Order;

    public function updateState(\App\Models\OrderState $orderState): Order;
}
