<?php
namespace hdliyu\framework\core;
use Exception;

class Facade{

    protected static function getAccessor(){
        throw new Exception('门面类必须定义getAccessor方法');
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = self::getInstance();
        return call_user_func_array([$instance,$name],$arguments);
    }

    protected static function getInstance(){
        return app(static::getAccessor());
    }
}