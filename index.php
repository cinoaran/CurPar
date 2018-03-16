<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

//Load configration end helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS .  'lib' . DS . 'helpers' . DS . 'functions.php');

//Autoload classes
function autoload($className){

    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')){

      require_once(ROOT . DS . 'core' . DS . $className . '.php');
    }
    elseif (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS .$className . '.php')){
      require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    }
    elseif (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')){
      require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }

}

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/') ) : [];
//GET DB CONNECTION TRUTH getInstance()
//$db = DB::getInstance();
if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    Users::loginUserFromCookie();

}
//ROUTE THE REQUEST
Router::route($url);
