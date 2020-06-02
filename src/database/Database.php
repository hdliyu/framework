<?php
namespace hdliyu\framework\database;

use hdliyu\framework\config\Config;

class Database
{
    // IOC 使用反射实现依赖注入
    public function __construct($a=1,Config $config)
    {
        
    }
    public function query()
    {
        echo 'database query';
    }

    public function insert()
    {
        echo 'database insert';
    }

    public function update()
    {
        echo 'database update';
    }

    public function delete()
    {
        echo 'database delete';
    }
}