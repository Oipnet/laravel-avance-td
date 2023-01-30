<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function index()
    {
        return $this->productRepository->getAll();
    }

    public function show(Product $product)
    {
        return $product;
    }
}
