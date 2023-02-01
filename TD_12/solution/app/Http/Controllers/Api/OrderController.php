<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {
    }

    public function index()
    {
        return new OrderCollection(
            $this->orderRepository->getAll(with: [
                'product', 'size', 'orderState',
            ], paginate: true)
        );
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
