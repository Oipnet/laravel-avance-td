<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepository;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, fn () => new ProductRepository(
            new Product()
        ));

        $this->app->singleton(CategoryRepositoryInterface::class, fn () => new CategoryRepository(
            new Category()
        ));

        $this->app->singleton(SizeRepositoryInterface::class, fn () => new SizeRepository(
            new Size()
        ));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
