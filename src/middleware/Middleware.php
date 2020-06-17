<?php
namespace hdliyu\framework\middleware;

class Middleware{
    use Dispatcher;
    public function global()
    {
        $this->exec(config('middleware.middleware'));
    }

    public function route(array $middleware){
        $middleware = array_filter(config('middleware.routeMiddleware'),function($v,$k) use($middleware){
            return in_array($k,$middleware);
        },ARRAY_FILTER_USE_BOTH);
        $this->exec($middleware);
    }
}