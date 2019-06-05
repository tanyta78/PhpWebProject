<?php 

spl_autoload_register();

$url = $_SERVER['REQUEST_URI'];

$self = str_replace(
    basename(__FILE__),
    '',
    $_SERVER['PHP_SELF']);
$url = explode('/',str_replace($self,'',$url));

$controllerName= array_shift($url);
$action = array_shift($url);

$app = new \Core\Application(
    $controllerName,
    $action,
    $url
);

$app->start();