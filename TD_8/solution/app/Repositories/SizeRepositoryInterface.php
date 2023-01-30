<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SizeRepositoryInterface
{
    public function setModel(Model $model);

    public function getAll(): Collection;

    public function findByCode(string $code);

    public function create(array $validatedData);

    public function update(array $data, int $id);
}
