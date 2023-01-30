<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;

    public function findbySlug(string $slug);

    public function create(array $data);
}
