<?php
$a = [1,2,0,3,false,5];

$b  = array_filter($a,function($v){
    return true;
});
print_r($b);


die;
$input = ['Auth','Session','asdfsaf'];

$middleware = [
    'Auth'=>'AuthMiddleware',
    'Session'=>'SessionMiddleware',
    'Cookie'=>'CookieMiddleware',
];

$new = array_filter($middleware,function($k) use($input){
    return in_array($k,$input);
},ARRAY_FILTER_USE_BOTH);
var_dump($new);