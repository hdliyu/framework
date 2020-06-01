<?php
function style(){
    return 'padding:5px;border-radius:5px;font-family:Consolas;font-size:15px;background:#2c3e50;color:#fff;';
}

function dump(...$vars){
    $style = style();
    $html = "<pre style='{$style}'>";
    if(!empty($vars)){
        foreach ($vars as $var) {
            $html.=var_export($var,true);
        }
    }else{
        $html.='请输入要打印的变量';
    }
    $html.='</pre>';
    echo $html;
}

function dd(...$vars){
    $style = style();
    $html = "<pre style='{$style}'>";
    ob_start();
    if(!empty($vars)){
        foreach ($vars as $var) {
            var_dump($var);
        }
    }else{
        echo '请输入要打印的变量';
    }
    $info = ob_get_clean();
    $html.=$info;
    $html.='</pre>';
    
    die($html);
}

function p(...$vars){
    $style = style();
    $html = "<pre style='{$style}'>";
    if(!empty($vars)){
        foreach ($vars as $var) {
            $html.=print_r($var,true).'<br>';
        }
    }else{
        $html.='请输入要打印的变量';
    }
    $html.='</pre>';
    echo $html;
}