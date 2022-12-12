<?php

namespace Sorethea\Hieat;

use Filament\PluginServiceProvider;
use Sorethea\Hieat\Filament\Resources\Settings\ActivityResource;
use Sorethea\Hieat\Filament\Resources\Settings\PermissionResource;
use Sorethea\Hieat\Filament\Resources\Settings\RoleResource;
use Sorethea\Hieat\Filament\Resources\Settings\UserResource;
use Spatie\LaravelPackageTools\Package;

class ResourceServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        ActivityResource::class,
        UserResource::class,
        RoleResource::class,
        PermissionResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package->name("hieat");
    }
}