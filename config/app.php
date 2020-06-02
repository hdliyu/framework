<?php
use hdliyu\framework\config\ConfigFacade;
use hdliyu\framework\config\ConfigProvider;
use hdliyu\framework\database\DatabaseFacade;
use hdliyu\framework\database\DatabaseProvider;

return [
    'name'=>'狂空怒',
    'webname'=>'后盾人，人人做后盾',
    'url'=>'https://www.houdunren.com',
    'providers'=>[
        ConfigProvider::class,
        DatabaseProvider::class,
    ],
    'facades'=>[
        'Config'=>ConfigFacade::class,
        'Database'=>DatabaseFacade::class,
    ]
];