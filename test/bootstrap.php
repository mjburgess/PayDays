<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib');

spl_autoload_register(function ($className) {
    if(substr($className, 0, 7) == 'PHPUnit') {return true;}
    require str_replace('\\', DIRECTORY_SEPARATOR, ltrim($className, '\\')) . '.php';
});