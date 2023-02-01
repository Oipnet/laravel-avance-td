<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function index(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('category.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        return view('category.show', compact('category'));
    }
}
