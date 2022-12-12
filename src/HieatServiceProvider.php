<?php

namespace Sorethea\Hieat;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class HieatServiceProvider extends PluginServiceProvider
{
    public function packageConfigured(Package $package): void
    {
        $package->name("hieat")
            ->hasConfigFile("hieat");
    }

}
