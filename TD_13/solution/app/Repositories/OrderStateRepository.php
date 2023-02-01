<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Models\OrderState;

#[Repository(interface: OrderStateRepositoryInterface::class, model: OrderState::class)]
class OrderStateRepository extends BaseRepository implements OrderStateRepositoryInterface
{
    public function findByCode(string $code): OrderState
    {
        return $this->model->where('code', $code)->firstOrFail();
    }
}
