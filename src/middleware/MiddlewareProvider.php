<?php
namespace hdliyu\framework\middleware;
use hdliyu\framework\core\App;
use hdliyu\framework\core\Provider;

class MiddlewareProvider extends Provider
{
    protected $defer = false;

    public function register(App $app)
    {
        $app->bind('Middleware',Middleware::class,true);
    }

    public function boot()
    {
        //执行全局中间件
        app('Middleware')->global();
    }

}