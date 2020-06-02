<?php
namespace hdliyu\framework\core;
use ReflectionClass;

class App extends Container
{
    //注册的服务
    protected $serviceProviders = [];
    //延迟注册的服务
    protected $deferProviders = [];
    //立即注册服务是否已全部启动
    protected $booted = false;
    protected static $app;

    public static function bootstrap()
    {
        self::$app = $app = new self();
        $app->init();
        $app->bindProviders();
        $app->boot();
    }

    public static function app(){
        return self::$app;
    }

    protected function init()
    {
        $this->defineConst();
        spl_autoload_register([$this,'autoloadFacade']);
    }
    
    protected function autoloadFacade($name)
    {
        $facades = config('app.facades');
        if(isset($facades[$name])){
            class_alias($facades[$name],$name);
        }
    }

    protected function defineConst()
    {
        define('ROOT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
        define('CONFIG_PATH',ROOT_PATH.'/config');
    }

    protected function bindProviders()
    {
       $appConfig = require CONFIG_PATH.'/app.php';
       foreach($appConfig['providers'] as $provider){   
           $reflection = new ReflectionClass($provider);
           $properties = $reflection->getDefaultProperties();
           if($properties['defer']){
               //延迟绑定
               $alias = substr($reflection->getShortName(),0,-8);
               $this->deferProviders[$alias] = $provider;
           }else{
               //立即绑定
               $this->register(new $provider($this));
           }
       }
    }

    //注册服务（执行服务提供者中的register方法）
    protected function register($provider)
    {
       if($this->getProvider($provider)) return;
       if(is_string($provider)){
           $provider = new $provider($this);
       }
       $provider->register($this);
       //下面两行不可调换位置，否则会造成死循环
       $this->serviceProviders[] = $provider;
       $this->booted && $provider->boot(); 
    }

    /**
     * 获取已经注册的服务对象
     */
    protected function getProvider($provider)
    {
        $class = is_object($provider)?get_class($provider):$provider;
        foreach($this->serviceProviders as $instance){
            if($instance instanceof $class){
                return $instance;
            }
        }
    }
    
    protected function boot()
    {
        foreach($this->serviceProviders as $provider){
            if(method_exists($provider,'boot')){
                $provider->boot($this);
            }
        }
        $this->booted = true;
    }

    public function make($name,$force=false){
        if(isset($this->deferProviders[$name])){
            $this->register($this->deferProviders[$name]);
        }
        return parent::make($name,$force);
    }

}