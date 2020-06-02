<?php
use hdliyu\framework\core\App;

function app($name=null,$force=false){
    $app = App::app();
    return is_null($name)?$app:$app->make($name,$force);
}

function config($name,$value='[@GET]'){
    if($value=='[@GET]'){
        return app('Config')->get($name);
    }
    app('Config')->set($name,$value);
}