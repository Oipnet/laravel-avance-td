<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection;

    public function create(array $data, array $roles): User;

    public function getAllAdmins();

    public function findByEmail(string $email);
}
