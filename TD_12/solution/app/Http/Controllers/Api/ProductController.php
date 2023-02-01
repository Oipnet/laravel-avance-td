<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function index()
    {
        return new ProductCollection(
            $this->productRepository->getAll(
                with: ['category', 'sizes'],
                paginate: true
            )
        );
    }

    public function show(Product $product)
    {
        $product->load(['category', 'sizes']);

        return new ProductResource($product);
    }
}
