<?php
namespace hdliyu\framework\config;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class ConfigProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        echo 'config register';
    }

    public function boot(App $app)
    {
        echo 'config boot';
    }

}