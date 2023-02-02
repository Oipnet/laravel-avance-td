<?php

namespace App\Repositories;

use App\Attributes\Repository;
use App\Events\ModelCreated;
use App\Events\ModelUpdated;
use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

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

        Cache::tags('sizes')->flush();

        ModelCreated::dispatch($this->model);
    }

    public function update(array $data, int $id)
    {
        $this->model = $this->model->find($id);
        $this->model->code = $data['code'];
        $this->model->libelle = $data['libelle'];

        $this->model->save();

        Cache::tags('sizes')->flush();

        ModelUpdated::dispatch($this->model);
    }

    public function getAll(array $with = [], bool $paginate = false): LengthAwarePaginator|Collection
    {
        if ($paginate) {
            return parent::getAll($with, $paginate);
        }

        $cacheKey = implode('.', array_merge(['sizes'], $with));

        return Cache::tags('sizes')->rememberForever($cacheKey, function () use ($with) {
            return $this->model->with($with)->get();
        });
    }
}
