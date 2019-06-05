<?php

namespace Core;

use Core\View\View;

class Application
{
    /** @var string */
    private $controllerName;
    /** @var string */
    private $actionName;
    /** @var string [] */
    private $parameters;

    /**
     * Application constructor.
     * @param string $controllerName
     * @param string $actionName
     * @param string[] $parameters
     */
    public function __construct(string $controllerName,
                                string $actionName,
                                array $parameters)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->parameters = $parameters;
    }

    public function start(){
        $controllerName = 'Controllers\\'
            . ucfirst($this->controllerName)
            .'Controller';
        $view = new View($this->controllerName,$this->actionName);
        $controller = new $controllerName($view);

        $actionInfo = new \ReflectionMethod(
            $controllerName,
            $this->actionName
        );

        $actionInfo->getParameters();


        call_user_func_array(
            [
                $controller,
                $this->actionName
            ],
            $this->parameters
        );
    }
}