<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SizeRepositoryInterface
{
    public function getAll(): Collection;
}
