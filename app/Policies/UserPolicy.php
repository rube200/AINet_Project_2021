<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends FuncionarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $this->canViewOrUpdate($user, $model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return true;
        //if ($this->canViewOrUpdate($user, $model))

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return bool
     */
    public function updateBlock(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return UserPolicy::isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return false
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public static function canViewOrUpdate(User $user, User $model): bool
    {
        if (UserPolicy::isAdmin($user))/* Se User for admin entao pode ver os admins e funcionarios */
            return UserPolicy::isFuncionario($model);

        if (UserPolicy::isFuncionario($model))/* Admin ja verificado | Se User forfuncionario entao nao pode ver ninguem */
            return false;

        return $user->id == $model->id;/* Resta apenas o cliente | Se for o proprio cliente autorizar */
    }

    public static function isAdmin(User $user): bool
    {
        return strtoupper($user->tipo) == 'A';
    }
}
