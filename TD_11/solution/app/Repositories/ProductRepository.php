<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Events\ModelCreated;
use App\Models\Product;

#[Repository(interface: ProductRepositoryInterface::class, model: Product::class)]
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function create(array $datas, array $relations)
    {
        $this->model = $this->model->newInstance();

        $this->model->title = $datas['title'];
        $this->model->slug = $datas['slug'];
        $this->model->description = $datas['description'];
        $this->model->price_in_cents = $datas['price_in_cents'];
        $this->model->category()->associate($relations['category']);

        $sizeIds = [];
        foreach ($relations['sizes'] as $size) {
            $sizeIds[$size->id] = ['stock' => 10];
        }

        $this->model->save();
        $this->model->sizes()->sync($sizeIds);

        ModelCreated::dispatch($this->model);
    }

    public function findProductWithStockLessThan(int $limit)
    {
        $products = $this->model->all();

        return $products->filter(function (Product $product) use ($limit) {
            return $product->sizes()->where('stock', '<', $limit)->count() > 0;
        });
    }
}
