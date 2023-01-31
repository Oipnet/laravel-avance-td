<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(): Collection;

    public function create(array $validatedData, array $array);

    public function findProductWithStockLessThan(int $limit);
}
