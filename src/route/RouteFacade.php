<?php
namespace hdliyu\framework\route;

use hdliyu\framework\core\Facade;

class RouteFacade extends Facade{

    public static function getAccessor()
    {
        return 'Route';
    }
}