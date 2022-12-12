<?php

namespace Sorethea\Hieat;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\Hieat\Filament\Resources\Settings\RoleResource;
use Sorethea\Hieat\Policies\Settings\ActivityPolicy;
use Sorethea\Hieat\Policies\Settings\PermissionPolicy;
use Sorethea\Hieat\Policies\Settings\RolePolicy;
use Sorethea\Hieat\Policies\Settings\UserPolicy;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class =>UserPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Activity::class => ActivityPolicy::class,
    ];
    public function register()
    {
        $this->registerPolicies();
    }
}