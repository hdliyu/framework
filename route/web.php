<?php

Route::get('/','HomeController@index');
Route::get('artilce/{id}',function($id,Config $config){
    var_dump($id,$config);
})->where(['id'=>'\d+']);