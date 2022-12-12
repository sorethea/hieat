<?php

namespace Sorethea\Hieat;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class ResourceServiceProvider extends PluginServiceProvider
{
    public function packageConfigured(Package $package): void
    {
        $package->name("hieat");
    }
}