<?php
namespace app\controllers;
use hdliyu\framework\core\Controller;

class User extends Controller{
    public function show($id){
        return '用户编号'.$id.'的个人中心';
    }
}