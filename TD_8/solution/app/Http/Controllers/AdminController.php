<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private SizeRepositoryInterface $sizeRepository,
        private OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function index(): View
    {
        $products = $this->productRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $sizes = $this->sizeRepository->getAll();
        $orders = $this->orderRepository->getAll();

        return view(
            'admin.index',
            compact(
                'products',
                'categories',
                'sizes',
                'orders'
            )
        );
    }
}
