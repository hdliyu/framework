<?php
namespace hdliyu\framework\config;

class Config{
    protected $config = [];
   
    public function load(){
        foreach(glob(CONFIG_PATH.'/*') as $file){
            $info = pathinfo($file);
            $this->config[$info['filename']] = include $file;
        }
    }
    
    public function set($name,$value)
    {
        $tmp = &$this->config;
        foreach(explode('.',$name) as $key){
            $tmp = &$tmp[$key];
        }
        $tmp = $value;
    }


    public function get($name=null,$default=null){
        $tmp = &$this->config;
        if(is_null($name)) return $tmp;
        foreach(explode('.',$name) as $key){
            if(!isset($tmp[$key])) return $default;
            $tmp = &$tmp[$key];
        }
        return $tmp;
    }
}