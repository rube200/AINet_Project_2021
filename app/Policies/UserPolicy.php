<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        switch (strtoupper($user->tipo)) {
            case 'A':
            case 'C':
                return true;

            default:
                return false;
        }
    }

    public function viewAny(User $user): bool
    {
        switch (strtoupper($user->tipo)) {
            case 'A':
                return true;

            default:
                return false;
        }
    }
}
