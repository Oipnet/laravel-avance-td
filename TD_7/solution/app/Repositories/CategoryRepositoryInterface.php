<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function setModel(Model $model);
    public function getAll(): Collection;

    public function findbySlug(string $slug);

    public function create(array $data);
}
