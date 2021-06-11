<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class FuncionarioPolicy
{
    use HandlesAuthorization;

    public function isFuncionario($user): bool
    {
        switch (strtoupper($user->tipo)) {
            case 'A':
            case 'F':
                return true;

            default:
                return false;
        }
    }
}
