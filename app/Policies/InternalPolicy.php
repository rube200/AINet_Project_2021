<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalPolicy
{
    use HandlesAuthorization;

    public static function isFuncionario($user): bool
    {
        switch (strtoupper($user->tipo)) {
            case 'A':
            case 'F':
                return true;

            default:
                return false;
        }
    }

    public static function isAdmin(User $user): bool
    {
        return strtoupper($user->tipo) == 'A';
    }
}
