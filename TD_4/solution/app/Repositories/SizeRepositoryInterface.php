<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SizeRepositoryInterface
{
    public function getAll(): Collection;

    public function findByCode(string $code);

    public function create(array $validatedData);

    public function update(array $data, int $id);
}
