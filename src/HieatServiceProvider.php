<?php

namespace Sorethea\Hieat;

use Illuminate\Support\ServiceProvider;

class HieatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(ResourceServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }
}