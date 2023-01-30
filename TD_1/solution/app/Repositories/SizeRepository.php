<?php

namespace App\Repositories;

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
    }
}
