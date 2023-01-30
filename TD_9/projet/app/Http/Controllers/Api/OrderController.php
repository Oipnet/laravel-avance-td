<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    )
    {
    }

    public function index()
    {
        return $this->orderRepository->getAll();
    }

    public function show(Order $order)
    {
        return $order;
    }
}
