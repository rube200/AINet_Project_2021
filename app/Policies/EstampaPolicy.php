<?php

namespace App\Policies;

use App\Models\Estampa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstampaPolicy extends InternalPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function view(?User $user, Estampa $estampa): bool
    {
        if (InternalPolicy::isFuncionario(optional($user)))
            return true;

        if (is_null($estampa->cliente_id))
            return true;

        return optional($user)->id == $estampa->cliente_id;
    }

    public function create(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function update(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function delete(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function restore(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function forceDelete(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }
}
