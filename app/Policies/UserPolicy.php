<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends FuncionarioPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, User $model): bool
    {
        return $this->canViewOrUpdate($user, $model);
    }

    public function update(User $user, User $model): bool
    {
        return $this->canViewOrUpdate($user, $model);
    }

    public static function canViewOrUpdate(User $user, User $model): bool
    {
        if (UserPolicy::isAdmin($user))/* Se User for admin entao pode ver os admins e funcionarios */
            return UserPolicy::isFuncionario($model);

        if (UserPolicy::isFuncionario($model))/* Admin ja verificado | Se User forfuncionario entao nao pode ver ninguem */
            return false;

        return $user->id == $model->id;/* Resta apenas o cliente | Se for o proprio cliente autorizar */
    }

    /** @noinspection PhpUnused */
    public function updateBlock(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    public function delete(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    public function restore(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public static function isAdmin(User $user): bool
    {
        return strtoupper($user->tipo) == 'A';
    }
}
