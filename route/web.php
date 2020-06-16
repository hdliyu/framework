<?php
use hdliyu\framework\config\Config;

Route::get('/','Index@index');
Route::get('user/{id}','User@show');
Route::get('article/{id}',function($id,Config $config){
    return 'cba id:'.$config->get('app.name');
})->where(['id'=>'\d+']);