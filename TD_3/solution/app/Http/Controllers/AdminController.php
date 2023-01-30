<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private SizeRepositoryInterface $sizeRepository,
    )
    {
    }

    public function index(): View
    {
        $products = $this->productRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $sizes = $this->sizeRepository->getAll();

        return view(
            'admin.index',
            compact(
                'products',
                'categories',
                'sizes'
            )
        );
    }
}
