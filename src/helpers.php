<?php
use hdliyu\framework\core\App;

function app($name=null,$force=false){
    $app = App::app();
    return is_null($name)?$app:$app->make($name,$force);
}

function config($name=null,$value='[@GET]'){
    if(is_null($name)) return app('Config')->get();
    if($value=='[@GET]'){
        return app('Config')->get($name);
    }
    app('Config')->set($name,$value);
}