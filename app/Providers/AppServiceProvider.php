<?php

namespace App\Providers;

use App\Models\BaseModel_LogsActivity;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $path = $this->app->environment() .'.app';
        $config = $this->app->make('config');
        $aliasLoader = AliasLoader::getInstance();

        if ($config->has($path)) {
            array_map([$this->app, 'register'], $config->get($path .'.providers'));

            foreach ($config->get($path .'.aliases') as $key => $class) {
                $aliasLoader->alias($key, $class);
            }
        }
    }
}
