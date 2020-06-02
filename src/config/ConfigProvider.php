<?php
namespace hdliyu\framework\config;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class ConfigProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        $app->bind('Config',Config::class,true);
    }

    public function boot()
    {
        $this->app->make('Config')->load();
    }

}