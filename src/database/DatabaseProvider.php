<?php
namespace hdliyu\framework\database;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class DatabaseProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        $app->bind('Database',Database::class,true);
    }

    public function boot()
    {
    }

}