<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function index()
    {
        return $this->categoryRepository->getAll();
    }

    public function show(Category $category)
    {
        return $category;
    }
}
