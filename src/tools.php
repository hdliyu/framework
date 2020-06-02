<?php
function dirSize($dir)
{
    $size= 0;
    foreach (glob($dir.'/*') as $file) {
        $size += is_file($file)?filesize($file):dirSize($file);
    }
    return $size;
}

function dir_total($dir){
    return space_total(dirSize($dir));
}


/**
 * 获取有单位的大小
 */
function space_total($total)
{
    $config = [4=>'TB',3 => 'GB', 2 => 'MB', 1 => 'KB', 0=> 'B'];
    foreach ($config as $num => $unit) {
        if ($total >= pow(1024, $num)) {
            return round($total / pow(1024, $num),2) . $unit;
        }
    }
    return 0;
}

function runtime($start=null,$end=null){
    static $cache = [];
    if(is_null($start)){
        return $cache;
    }elseif(is_null($end)){
        $cache[$start] = microtime(true);
    }else{
        $end = $cache[$end]??microtime(true);
        return $end - $cache[$start];
    }
}


function style(){
    return 'padding:5px;border-radius:5px;font-family:Consolas;font-size:15px;background:#2c3e50;color:#fff;';
}

function dump(...$vars){
    $style = style();
    $html = "<pre style='{$style}'>";
    if(!empty($vars)){
        foreach ($vars as $var) {
            $html.=var_export($var,true).'<br>';
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


/************************** 文件处理相关 *************************/

/**
 * 递归删除目录
 */
function delDir($dir){
    if(!is_dir($dir)) return true;
    foreach(glob($dir.'/*') as $file){
        is_dir($file)?delDir($file):unlink($file);
    }
    return rmdir($dir);
}
/**
 * 复制目录 
 */
function copyDir($from,$to){
    if(!is_dir($from)) return true;
    if(!is_dir($to))
        mkdir($to,0777,true);
    foreach(glob($from.'/*') as $file){
        $tmp =  basename($file);
        is_dir($file)?copyDir($file,$to.'/'.$tmp):copy($file,$to.'/'.$tmp);
    }
    return true;
}
function moveDir($from,$to){
    copyDir($from,$to);
    return delDir($from);
}

/**
 *  为目录下面的文件添加编号
 * @param $dir 要操作的目录
 * @param $index 编号起始位置
 * @param $prefix 编号前导零数量 负数去掉编号
 * @param $dot 编号和文件名分隔字符
 * @param $recursive 是否递归修改
 */
function addIndexOfFile($dir,$index=1,$prefix=0,$dot=' ',$recursive=false){
    if(!is_dir($dir)) return false;
    foreach(glob($dir.'/*') as $file){
       $num = $prefix<0?'':($index<pow(10,$prefix+1)?str_repeat('0',$prefix).$index:$index).$dot;
       if(is_file($file)){
           $name = preg_replace('/^[\d\s\.]+/','',basename($file));
           $newname = str_replace(basename($file),$num.$name,$file);
           rename($file,$newname);
           $index++;
       }else{
           $recursive && addIndexOfFile($file,$recursive,$index,$prefix,$dot);
       }
    }
    return true;
}