<?php
namespace hdliyu\framework\core;

abstract class Container
{
    // 普通服务对象容器
    protected $building = [];
    // 单例服务对象容器
    protected $instances = [];
    public function bind($name,$closure,$force=false){
        $this->building[$name] = compact('closure','force');
    }
    public function instance($name,$instance){
        $this->instances[$name] = $instance;
    }
    protected function make($name,$force){
        if(isset($this->instances[$name])){
            return $this->instances[$name];
        }
        $closure = $this->getClosure($name);
        $instance = $this->build($closure);
        //服务是否绑定单例
        if($this->building[$name]['force'] || $force){
            $this->instances[$name] = $instance;
        }
        return $instance;
    }

    protected function build($closure){
        return $closure();
    }

    protected function getClosure($name){
        return isset($this->building[$name])?$this->building[$name]['closure']:$name;
    }

}