<?php
namespace hdliyu\framework\core;

class App{
    static $app = null;

    public static function bootstrap()
    {
        self::$app = $app = new self();
        $app->boot();
        $app->bindProviders();
    }

    public function boot(){
        define('ROOT_PATH',str_replace('\\','/',realpath(__DIR__.'/../../')));
        define('CONFIG_PATH',ROOT_PATH.'/config');
    }

    protected function bindProviders()
    {
       $appConfig = require CONFIG_PATH.'/app.php';
       foreach($appConfig['providers'] as $provider){
           
       }
    }
}