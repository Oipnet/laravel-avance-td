<?php

namespace App\Repositories;

use App\Events\ModelCreated;
use App\Models\Product;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function findByCode(string $code): Role
    {
        return $this->model->where('code', $code)->firstOrFail();
    }
}
