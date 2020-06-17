<?php
namespace hdliyu\framework\middleware;

use hdliyu\framework\core\Facade;

class MiddlewareFacade extends Facade{

    public static function getAccessor()
    {
        return 'Middleware';
    }
}