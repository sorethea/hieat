<?php

namespace Sorethea\Hieat;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\Hieat\Policies\Settings\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class =>UserPolicy::class,
    ];
    public function register()
    {
        $this->registerPolicies();
    }
}