<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoleRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection;

    public function findByCode(string $code): Role;
}
