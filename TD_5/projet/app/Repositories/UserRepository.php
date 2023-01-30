<?php

namespace App\Repositories;

use App\Events\ModelCreated;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function create(array $data, array $roles): User
    {
        $this->model->newInstance();

        $this->model->name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->password = Hash::make($data['password']);

        $this->model->save();

        if (count($roles)) {
            $this->model->roles()->sync(
                array_map(fn (Role $role) => $role->id, $roles)
            );
        }

        return $this->model;
    }

    public function getAllAdmins()
    {
        return $this->model->whereHas('roles', function (Builder $query) {
            $query->where('code', 'ROLE_ADMIN');
        })->get();
    }
}
