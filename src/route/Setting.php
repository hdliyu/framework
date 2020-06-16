<?php
namespace hdliyu\framework\route;

trait Setting{
    protected $routes = [];
    public function load()
    {
        foreach(glob(ROOT_PATH.'/route/*') as $file){
            include $file;
        }
    }

    public function __call($name,$arguments)
    {
       $this->routes[] = [
           'method'=>$name,
           'path'=>$arguments[0],
           'action'=>$arguments[1],
           'where'=>[]
       ];
       return $this;
    }

    public function where($params)
    {
        $this->setProperty('where',$params);
        return $this;
    }
    
    protected function setProperty($name,$params)
    {
        $index = count($this->routes)-1;
        $this->routes[$index][$name] = $params;
    }
}