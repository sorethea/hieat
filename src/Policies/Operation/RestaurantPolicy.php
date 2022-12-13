<?php

namespace Sorethea\Hieat\Policies\Operation;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can("restaurants.index");
    }

    public function view(User $user, Restaurant $restaurant): bool
    {
        return $user->can("restaurants.show");
    }

    public function create(User $user): bool
    {
        return $user->can("restaurants.create");
    }

    public function update(User $user, Restaurant $restaurant): bool
    {
        return $user->can("restaurants.edit");
    }

    public function delete(User $user, Restaurant $restaurant): bool
    {
        return $user->can("restaurants.delete");
    }

    public function restore(User $user, Restaurant $restaurant): bool
    {
        return $user->can("restaurants.restore");
    }

    public function forceDelete(User $user, Restaurant $restaurant): bool
    {
        return $user->can("restaurants.destroy");
    }
}