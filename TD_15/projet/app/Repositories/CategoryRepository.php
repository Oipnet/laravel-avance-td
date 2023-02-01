<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Events\ModelCreated;
use App\Models\Category;

#[Repository(interface: CategoryRepositoryInterface::class, model: Category::class)]
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function findbySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        $this->model = $this->model->newInstance();

        $this->model->libelle = $data['libelle'];
        $this->model->slug = $data['slug'];

        $this->model->save();

        ModelCreated::dispatch($this->model);
    }
}
