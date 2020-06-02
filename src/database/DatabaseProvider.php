<?php
namespace hdliyu\framework\database;
use hdliyu\framework\core\Provider;
use hdliyu\framework\core\App;

class DatabaseProvider extends Provider
{

    public function register(App $app)
    {
        $app->bind('Database',Database::class,true);
        // 绑定单例服务
        // $app->instance('Database',new Database());
        // $app->bind('Database',function() use ($app){
        //     return new Database($app);
        // },true);
    }

    public function boot()
    {
    }

}