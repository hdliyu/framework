<?php
namespace hdliyu\framework\core;

abstract class Provider
{
    //是否延迟绑定
    protected $defer =  true;
    protected $app;
    
    abstract protected function register(App $app);

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}