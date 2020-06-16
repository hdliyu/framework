<?php
namespace hdliyu\framework\route;

use Closure;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

trait Execute{
    protected $route;
    public function exec()
    {
        $this->parseRoute();
        if(!$this->route) die('404');
        $action = $this->route['action'];
        if($action instanceof Closure){
           return $this->callClosure($action);
        }else{
           return $this->callController($action);
        }
    }
    public function callController($action)
    {
        list($controller,$method) = explode('@',$action);
        $obj = app('app\\controllers\\'.$controller);
        $reflection = new ReflectionMethod($obj,$method);
        $args = [];
        foreach($reflection->getParameters() as $param){
            $name = $param->name;
            if(isset($this->route['matches'][$name])){
                $args[] = $this->route['matches'][$name];
            }elseif($class = $param->getClass()){
                $args[] = app($class->getShortName());
            }
        }
        return $reflection->invokeArgs($obj,$args);
    }
    public function callClosure($closure)
    {
        $reflection = new ReflectionFunction($closure);
        $args = [];
        foreach($reflection->getParameters() as $param){
            $name = $param->name;
            if(isset($this->route['matches'][$name])){
                $args[] = $this->route['matches'][$name];
            }elseif($class = $param->getClass()){
                $args[] = app($class->getShortName());
            }
        }
        return $reflection->invokeArgs($args);
    }
    public function parseRoute()
    {
        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        foreach($this->routes as $route){
            $reg = '#^/?'.$route['path'].'/?$#i';
            $isMatch = preg_match($reg,$url,$matches);
            if($isMatch && $this->checkMethod($route)){
               $route['matches'] = array_filter($matches,function($v,$k){
                    return is_string($k);
               },ARRAY_FILTER_USE_BOTH);
               $this->route =  $route;
               break; //找到第一次匹配路由就终止
            }
        }
    }

    public function checkMethod($route)
    {
        return $route['method'] == strtolower($_SERVER['REQUEST_METHOD']);
    }

}