<?php
namespace hdliyu\framework\database;

use hdliyu\framework\core\Facade;

class DatabaseFacade extends Facade
{

    public static function getAccessor()
    {
        return 'Database';
    }

}