<?php
namespace hdliyu\framework\route;

trait Compile{

    public function format()
    {
        foreach($this->routes as &$route){
            $this->parseWhere($route);
            $this->parseNonWhere($route);
        }
    }

    // Route::get('artilce/{id}',function($id,Config $config){
    //     var_dump($id,$config);
    // })->where(['id'=>'\d+']);

    protected function parseWhere(&$route)
    {
        foreach($route['where'] as $k=>$v){
            $reg = "/\{($k)\}/"; //{id}
            $route['path'] = preg_replace_callback($reg,function($match) use($k,$v){
                return "(?<{$k}>{$v})";
            },$route['path']);
        }
    }

    protected function parseNonWhere(&$route){
        $reg = "/\{(?<name>\w+)\}/";
        $route['path'] = preg_replace_callback($reg,function($match){
            return "(?<{$match['name']}>\w+)";
        },$route['path']);
    }
}