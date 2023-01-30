<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderStateRepositoryInterface
{
    public function setModel(Model $model);
    public function getAll(): Collection;

    public function findByCode(string $code);
}
