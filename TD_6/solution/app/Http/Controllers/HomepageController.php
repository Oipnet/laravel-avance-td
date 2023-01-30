<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('homepage', compact('products'));
    }
}
