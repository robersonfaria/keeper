<?php

namespace Jakjr\Keeper;

use Illuminate\Support\ServiceProvider;

class KeeperSeviceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('keeper', function($app, $params)
        {
            $context = $params[0] ?: null;
            return new Keeper($context, app('Illuminate\Session\Store'));
        });
    }
}
