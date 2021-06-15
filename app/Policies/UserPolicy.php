<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends InternalPolicy
{
    public function viewAny(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    public function view(User $user, User $model): bool
    {
        return $this->canViewOrUpdate($user, $model);
    }

    public static function canViewOrUpdate(User $user, User $model): bool
    {
        if (InternalPolicy::isAdmin($user))/* Se User for admin entao pode ver os admins e funcionarios */
            return InternalPolicy::isFuncionario($model);

        if (InternalPolicy::isFuncionario($model))/* Admin ja verificado | Se User forfuncionario entao nao pode ver ninguem */
            return false;

        return $user->id == $model->id;/* Resta apenas o cliente | Se for o proprio cliente autorizar */
    }

    public function edit(User $user, User $model): bool
    {
        return $this->canViewOrUpdate($user, $model);
    }

    public function updateBlock(User $user, User $model): bool
    {
        //Nao faz sentido o utilizador se bloquear a ele mesmo
        return $user->id != $model->id && InternalPolicy::isAdmin($user);
    }

    public function delete(User $user, User $model): bool
    {
        //Nao faz sentido o utilizador apagar a propria conta
        return $user->id != $model->id && InternalPolicy::isAdmin($user);
    }

    public function restore(User $user): bool
    {
        return InternalPolicy::isAdmin($user);
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
