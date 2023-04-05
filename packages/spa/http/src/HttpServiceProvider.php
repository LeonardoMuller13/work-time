<?php

namespace Spa\Http;

use Illuminate\Support\ServiceProvider;
use MaisApp\Http\ViewComposers\AdminComposer;

class HttpServiceProvider extends ServiceProvider
{
    public function register()
    {
        //$this->app->singleton(AdminComposer::class);
        //$this->app->singleton(SubdomainComposer::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'spa');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}

