<?php

namespace Sorethea\Hieat\Policies\Settings;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can("permissions.index");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function view(User $user, Permission $model)
    {
        return $user->can("permissions.show");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can("permissions.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function update(User $user, Permission $model)
    {
        return $user->can("permissions.edit");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function delete(User $user, Permission $model)
    {
        return $user->can("permissions.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function restore(User $user, Permission $model)
    {
        return $user->can("permissions.restore");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function forceDelete(User $user, Permission $model)
    {
        return $user->can("permissions.destroy");
    }
}
