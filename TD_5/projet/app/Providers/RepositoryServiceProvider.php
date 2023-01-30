<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Product;
use App\Models\Role;
use App\Models\Size;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderStateRepository;
use App\Repositories\OrderStateRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\SizeRepository;
use App\Repositories\SizeRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
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

        $this->app->singleton(RoleRepositoryInterface::class, fn () => new RoleRepository(
            new Role()
        ));

        $this->app->singleton(UserRepositoryInterface::class, fn () => new UserRepository(
            new User()
        ));

        $this->app->singleton(OrderRepositoryInterface::class, fn () => new OrderRepository(
            new Order()
        ));

        $this->app->singleton(OrderStateRepositoryInterface::class, fn () => new OrderStateRepository(
            new OrderState()
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
