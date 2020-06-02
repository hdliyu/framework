<?php
require __DIR__.'/../vendor/autoload.php';
use hdliyu\framework\core\App;
App::bootstrap();
dd(Config::get('app.name'));