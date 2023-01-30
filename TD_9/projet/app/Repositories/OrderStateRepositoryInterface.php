<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderStateRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(): Collection;

    public function findByCode(string $code);
}
