<?php
namespace hdliyu\framework\database;
use hdliyu\framework\core\Provider;
use hdliyu\framework\core\App;

class DatabaseProvider extends Provider
{

    public function register(App $app)
    {
        echo 'database register';
    }

    public function boot()
    {
        echo 'database boot';
    }

}