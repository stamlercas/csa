<?php
    $production = true;
    
    
    //define('PUBLIC_PATH', realpath( dirname(__FILE__)) . "/");
    define('PUBLIC_PATH', /*realpath( __DIR__) .*/ "/");
    define('BASE_PATH', realpath( dirname(PUBLIC_PATH)) . "/");
    //define('BASE_PATH', '/');
    define('SECURITY_PATH', BASE_PATH . "security/");
    define('LIB_PATH', BASE_PATH . "lib/");
    
?>