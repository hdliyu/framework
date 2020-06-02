<?php
namespace app\controllers;

use hdliyu\framework\core\Controller;

class Article extends Controller{
    public function show($id){
        return '文章编号'.$id.'的文章详情';
    }
}