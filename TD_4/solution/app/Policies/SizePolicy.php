<?php

namespace App\Policies;

use App\Models\Size;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SizePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Size $size)
    {
        return $user->roles()->where('code', 'ROLE_ADMIN')->count() ?
            Response::allow() :
            Response::deny('Interdit de mettre a jour la taille');
    }
}
