<?php
namespace app\middlewares;

class RouteMiddleware{
    public function handle($next)
    {
        app('Route')->bootstrap();
        $next();
    }
}