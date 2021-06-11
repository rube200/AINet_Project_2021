<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class FuncionarioPolicy
{
    use HandlesAuthorization;

    /** @noinspection PhpMissingReturnTypeInspection */
    public function isFuncionario($user)
    {
        switch (strtoupper($user->tipo)) {
            case 'A':
            case 'F':
                return true;
        }
    }
}
