<?php 

spl_autoload_register();

$url = $_SERVER['REQUEST_URI'];

$self = str_replace(
    basename(__FILE__),
    '',
    $_SERVER['PHP_SELF']);
$url = explode('/',str_replace($self,'',$url));

$controllerName= ucfirst(array_shift($url));
$action = array_shift($url);

$controller = new $controllerName();

call_user_func([$controller,$action],$url);