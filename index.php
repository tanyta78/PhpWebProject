<?php 

spl_autoload_register();

$uri = explode('/',$_SERVER['REQUEST_URI']);

array_shift($uri);

$className = ucfirst(array_shift($uri));
$methodName = array_shift($uri);
$classFullName = 'Controllers\\'.$className.'Controller';

$view = new \Core\View();

$obj = new $classFullName($view);

if(is_callable([$obj,$methodName])){
    call_user_func_array([$obj,$methodName],$uri);
}else{
    echo '404 not found';
}