<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderState;
use App\Notifications\UpdateOrderState;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderStateRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderStateController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    )
    {
    }

    public function update(Order $order, OrderState $orderState): RedirectResponse
    {
        $this->orderRepository->setModel($order);
        $this->orderRepository->updateState($orderState);

        Notification::send($order->user, new UpdateOrderState($order));

        return redirect()->route('admin_index')->with('success', 'Commande mise a jour');
    }
}
