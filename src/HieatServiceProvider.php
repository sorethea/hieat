<?php

namespace Sorethea\Hieat;

use Filament\PluginServiceProvider;
use Sorethea\Hieat\Filament\Resources\Settings\PermissionResource;
use Sorethea\Hieat\Filament\Resources\Settings\RoleResource;
use Sorethea\Hieat\Filament\Resources\Settings\UserResource;
use Spatie\LaravelPackageTools\Package;

class HieatServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        UserResource::class,
        PermissionResource::class,
        RoleResource::class,
    ];
    public function packageConfigured(Package $package): void
    {
        $package->name("hieat");
    }

}
