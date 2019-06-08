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
    $queryString,
    $self,
    $_SERVER['HTTP_HOST']);

$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);

$container= new \Core\DependencyManagement\Container();
$container->cache(\Core\DependencyManagement\ContainerInterface::class,$container);
$container->cache(\Database\DatabaseInterface::class,$db);
$container->cache(\Core\Http\RequestContextInterface::class,$request);
$container->addDependency(\Core\ModelBinding\ModelBinderInterface::class,
    \Core\ModelBinding\ModelBinder::class);
$container->addDependency(\Service\User\UserServiceInterface::class,
 \Service\User\UserService::class);
$container->addDependency(\Repository\User\UserRepositoryInterface::class,
 \Repository\User\UserRepository::class);
$container->addDependency(\Core\View\ViewInterface::class,
    \Core\View\View::class);
$container->addDependency(\Core\ApplicationInterface::class,
    \Core\Application::class);
$container->addDependency(\Core\Http\UrlBuilderInterface::class,
    \Core\Http\UrlBuilder::class);

$app = $container->resolve(\Core\ApplicationInterface::class);
$app->start();