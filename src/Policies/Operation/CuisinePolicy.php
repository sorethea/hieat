<?php

namespace Sorethea\Hieat\Policies\Operation;

use App\Models\Cuisine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CuisinePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can("cuisines.index");
    }

    public function view(User $user, Cuisine $cuisine): bool
    {
        return $user->can("cuisines.show");
    }

    public function create(User $user): bool
    {
        return $user->can("cuisines.create");
    }

    public function update(User $user, Cuisine $cuisine): bool
    {
        return $user->can("cuisines.edit");
    }

    public function delete(User $user, Cuisine $cuisine): bool
    {
        return $user->can("cuisines.delete");
    }

    public function restore(User $user, Cuisine $cuisine): bool
    {
        return $user->can("cuisines.restore");
    }

    public function forceDelete(User $user, Cuisine $cuisine): bool
    {
        return $user->can("cuisines.destroy");
    }
}