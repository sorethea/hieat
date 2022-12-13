<?php

namespace Sorethea\Hieat\Policies\Operation;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can("foods.index");
    }

    public function view(User $user, Food $food): bool
    {
        return $user->can("foods.show");
    }

    public function create(User $user): bool
    {
        return $user->can("foods.create");
    }

    public function update(User $user, Food $food): bool
    {
        return $user->can("foods.edit");
    }

    public function delete(User $user, Food $food): bool
    {
        return $user->can("foods.delete");
    }

    public function restore(User $user, Food $food): bool
    {
        return $user->can("foods.restore");
    }

    public function forceDelete(User $user, Food $food): bool
    {
        return $user->can("foods.destroy");
    }
}