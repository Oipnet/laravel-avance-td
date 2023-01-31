<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RoleRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(): Collection;

    public function findByCode(string $code): Role;
}
