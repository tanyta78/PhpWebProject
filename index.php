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
$queryString = $_SERVER['QUERY_STRING'];

$modelBinder = new \Core\ModelBinding\ModelBinder();
$request = new \Core\Http\RequestContext(
    $controllerName,
    $action,
    $url,
    $queryString);

$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);

$app = new \Core\Application(
    $request,
    $modelBinder
);

$app->start();