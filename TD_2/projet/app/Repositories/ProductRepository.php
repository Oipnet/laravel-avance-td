<?php

namespace App\Repositories;

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
    }
}
