<?php
namespace app\middlewares;

class SessionMiddleware{
    public function handle($next)
    {
        $next();
    }
}