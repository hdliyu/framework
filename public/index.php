<?php
require __DIR__.'/../vendor/autoload.php';
use hdliyu\framework\core\App;
App::bootstrap();
dd(config('app.name'));