<?php

namespace Sorethea\Hieat\Policies\Settings;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;

class RolePolicy
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
        return $user->can("roles.index");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $model
     * @return Response|bool
     */
    public function view(User $user, Role $model)
    {
        return $user->can("roles.show");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can("roles.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Role $model
     * @return Response|bool
     */
    public function update(User $user, Role $model)
    {
        return $user->can("roles.edit");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Role $model
     * @return Response|bool
     */
    public function delete(User $user, Role $model)
    {
        return $user->can("roles.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Role $model
     * @return Response|bool
     */
    public function restore(User $user, Role $model)
    {
        return $user->can("roles.restore");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Role $model
     * @return Response|bool
     */
    public function forceDelete(User $user, Role $model)
    {
        return $user->can("roles.destroy");
    }
}
