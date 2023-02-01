<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\OpenApi\Responses\ListCategoriesResponse;
use App\OpenApi\Responses\ListProductsResponse;
use App\Repositories\CategoryRepositoryInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;


class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * Liste des categories
     */
    public function index()
    {
        return new CategoryCollection($this->categoryRepository->getAll(paginate: true));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
}
