<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Models\Role;

#[Repository(interface: RoleRepositoryInterface::class, model: Role::class)]
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function findByCode(string $code): Role
    {
        return $this->model->where('code', $code)->firstOrFail();
    }
}
