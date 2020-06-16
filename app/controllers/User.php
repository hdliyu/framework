<?php
namespace app\controllers;

use hdliyu\framework\config\Config;
use hdliyu\framework\core\Controller;

class User extends Controller{
    public function show($id,Config $config){
        return '用户编号'.$id.'的个人中心:'.$config->get('app.url');
    }
}