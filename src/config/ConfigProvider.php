<?php
namespace hdliyu\framework\config;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class ConfigProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        $app->bind('config',function() use ($app){
            return new Config($app);
        });
    }

    public function boot(App $app)
    {
    }

}