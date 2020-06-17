<?php
use hdliyu\framework\config\ConfigFacade;
use hdliyu\framework\config\ConfigProvider;
use hdliyu\framework\database\DatabaseFacade;
use hdliyu\framework\database\DatabaseProvider;
use hdliyu\framework\middleware\MiddlewareFacade;
use hdliyu\framework\middleware\MiddlewareProvider;
use hdliyu\framework\route\RouteFacade;
use hdliyu\framework\route\RouteProvider;

return [
    'name'=>'狂空怒',
    'webname'=>'后盾人，人人做后盾',
    'url'=>'https://www.houdunren.com',
    'providers'=>[
        ConfigProvider::class,
        DatabaseProvider::class,
        RouteProvider::class,
        MiddlewareProvider::class,
    ],
    'facades'=>[
        'Config'=>ConfigFacade::class,
        'Database'=>DatabaseFacade::class,
        'Route'=>RouteFacade::class,
        'Middleware'=>MiddlewareFacade::class,
    ]
];