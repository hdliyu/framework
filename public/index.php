<?php
require __DIR__.'/../vendor/autoload.php';
use hdliyu\framework\core\App;
App::bootstrap();
App::app()->make('Database');