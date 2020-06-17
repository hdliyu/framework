<?php
namespace hdliyu\framework\middleware;

trait Dispatcher{
    public function exec(array $middlewares)
    {   
       $dispatcher = array_reduce(array_reverse($middlewares),$this->getSlice(),function(){});
        $dispatcher();
    }

    public function getSlice()
    {
        return function($next,$middleware){
            return function() use ($next,$middleware){
                call_user_func([new $middleware,'handle'],$next);
            };
        };
    }
}