<?php

use app\middlewares\AuthMiddleware;
use app\middlewares\RouteMiddleware;
use app\middlewares\SessionMiddleware;

return [
    'middleware'=>[
        SessionMiddleware::class,
        RouteMiddleware::class,
    ],
    'routeMiddleware'=>[
        'Auth'=>AuthMiddleware::class,
    ]
];