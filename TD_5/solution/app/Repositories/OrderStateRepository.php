<?php

namespace App\Repositories;

use App\Events\ModelCreated;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrderStateRepository extends BaseRepository implements OrderStateRepositoryInterface
{
    public function findByCode(string $code): OrderState
    {
        return $this->model->where('code', $code)->firstOrFail();
    }
}
