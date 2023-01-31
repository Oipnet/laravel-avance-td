<?php

namespace App\Repositories;

use App\Events\ModelCreated;

class xCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
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
