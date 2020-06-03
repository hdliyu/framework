<?php
namespace hdliyu\framework\route;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class RouteProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        $app->bind('Route',Route::class,true);
    }

    public function boot()
    {
        $this->app->make('Route')->load();
    }

}