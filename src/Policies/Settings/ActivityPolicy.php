<?php

namespace Sorethea\Hieat\Policies\Settings;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
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
        return $user->can("activityLogs.index");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Activity $activity)
    {
        return $user->can("activityLogs.view");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Activity $activity)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Activity $activity)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Activity $activity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Activity $activity)
    {
        //
    }
}
