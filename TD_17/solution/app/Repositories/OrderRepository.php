<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Models\Order;
use App\Models\OrderState;

#[Repository(interface: OrderRepositoryInterface::class, model: Order::class)]
class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        $this->model->newInstance();

        $this->model->user()->associate($data['user']);
        $this->model->product()->associate($data['product']);
        $this->model->size()->associate($data['size']);
        $this->model->orderState()->associate($data['orderState']);
        $this->model->price_in_cents = $data['product']->price_in_cents;

        $this->model->save();

        return $this->model;
    }

    public function updateState(OrderState $orderState): Order
    {
        $this->model->orderState()->associate($orderState);
        $this->model->save();

        return $this->model;
    }
}
