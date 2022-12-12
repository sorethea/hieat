<?php

namespace Sorethea\Hieat\Policies\Operation;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class OrderPolicy
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
        return $user->can("orders.index");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Order $model
     * @return Response|bool
     */
    public function view(User $user, Order $model)
    {
        return $user->can("orders.show");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //return $user->can("orders.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Order $model
     * @return Response|bool
     */
    public function update(User $user, Order $model)
    {
        //return $user->can("orders.edit");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Order $model
     * @return Response|bool
     */
    public function delete(User $user, Order $model)
    {
       // return $user->can("orders.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Order $model
     * @return Response|bool
     */
    public function restore(User $user, Order $model)
    {
       // return $user->can("orders.restore");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Order $model
     * @return Response|bool
     */
    public function forceDelete(User $user, Order $model)
    {
        //return $user->can("orders.destroy");
    }
}
