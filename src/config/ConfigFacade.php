<?php
namespace hdliyu\framework\config;

use hdliyu\framework\core\Facade;

class ConfigFacade extends Facade{

    public static function getAccessor()
    {
        return 'Config';
    }
}