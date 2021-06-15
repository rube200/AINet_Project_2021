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

    public function manage(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function update(User $user, Estampa $estampa)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function delete(User $user, Estampa $estampa)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function restore(User $user, Estampa $estampa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function forceDelete(User $user, Estampa $estampa)
    {
        //
    }
}
