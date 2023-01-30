<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Events\ModelCreated;
use App\Events\ModelUpdated;
use App\Models\Size;

#[Repository(interface: SizeRepositoryInterface::class, model: Size::class)]
class SizeRepository extends BaseRepository implements SizeRepositoryInterface
{
    public function findByCode(string $code)
    {
        return $this->model->where('code', $code)->firstOrFail();
    }

    public function create(array $data)
    {
        $this->model = $this->model->newInstance();

        $this->model->libelle = $data['libelle'];
        $this->model->code = $data['code'];

        $this->model->save();

        ModelCreated::dispatch($this->model);
    }

    public function update(array $data, int $id)
    {
        $this->model = $this->model->find($id);
        $this->model->code = $data['code'];
        $this->model->libelle = $data['libelle'];

        $this->model->save();

        ModelUpdated::dispatch($this->model);
    }
}
