<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Notifications\NewOrder;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderStateRepositoryInterface;
use App\Repositories\SizeRepository;
use App\Repositories\SizeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private OrderStateRepositoryInterface $orderStateRepository,
        private SizeRepositoryInterface $sizeRepository,
        private UserRepositoryInterface $userRepository,
    )
    {
    }

    public function create(Request $request, Product $product): RedirectResponse
    {
        $orderState = $this->orderStateRepository->findByCode('COMMANDE');
        $size = $this->sizeRepository->findByCode($request->get('size'));

        $data =[
            'size' => $size,
            'product' => $product,
            'user' => Auth::user(),
            'orderState' => $orderState,
        ];

        $order = $this->orderRepository->create($data);

        $admins = $this->userRepository->getAllAdmins();
        Notification::send($admins, new NewOrder($order));
        return redirect()->route('homepage')->with('success', 'Votre commande a bien été enregistrée');
    }
}
