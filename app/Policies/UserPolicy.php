<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        if ($user->isSupervisor()) {
            return true;
        }
    }

    public function updateUser(User $userCheck, User $userUpdate)
    {
        return $userCheck->id === $userUpdate->id;
    }
}
