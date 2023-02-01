<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
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
        return new CategoryCollection($this->categoryRepository->getAll(paginate: true));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
}
