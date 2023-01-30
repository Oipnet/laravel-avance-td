<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;

    public function create(array $validatedData, array $array);

    public function findProductWithStockLessThan(int $limit);
}
