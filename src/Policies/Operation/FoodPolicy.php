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

    }

    public function view(User $user, Food $food): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Food $food): bool
    {
    }

    public function delete(User $user, Food $food): bool
    {
    }

    public function restore(User $user, Food $food): bool
    {
    }

    public function forceDelete(User $user, Food $food): bool
    {
    }
}