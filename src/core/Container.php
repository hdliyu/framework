<?php
namespace hdliyu\framework\core;

use Closure;
use Exception;
use ReflectionClass;

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
        dump($name);
        if(isset($this->instances[$name])){
            return $this->instances[$name];
        }
        $closure = $this->getClosure($name);
        $instance = $this->build($closure);
        //服务是否绑定单例
        if(isset($this->building[$name]) && $this->building[$name]['force'] || $force){
            $this->instances[$name] = $instance;
        }
        return $instance;
    }
    protected function getClosure($name){
        return isset($this->building[$name])?$this->building[$name]['closure']:$name;
    }
    /**
     * 构建服务对象
     */
    protected function build($closure){
        //如果是实现是回调函数返回调用结果
        if($closure instanceof Closure){
            return $closure($this);
        }
        $reflection = new ReflectionClass($closure);
        $constructor = $reflection->getConstructor();
        //没有构造函数的类直接实例化返回
        if(is_null($constructor)){
            return new $closure;
        }
        //有构造函数参数的依赖注入处理
        $parameters = $constructor->getParameters();
        $parameters = $this->parseParams($parameters);
        return $reflection->newInstanceArgs($parameters);
    }

    /**
     * 分析服务对象构造函数参数
     */
    protected function parseParams($parameters)
    {
        $parameter = [];
        foreach($parameters as $param){
            $class = $param->getClass();
            if(is_null($class)){
                //基本类型
                $parameter[] = $this->parseNonParam($param);
            }else{
                //类
                $parameter[] = $this->build($class->name);
            }
        }
        return $parameter;
    }
    
    protected function parseNonParam($param)
    {
        if($param->isDefaultValueAvailable()){
           return $param->getDefaultValue();
        }
        throw new Exception('默认值缺少参数');
    }
}