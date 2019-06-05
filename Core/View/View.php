<?php


namespace Core\View;


class View implements ViewInterface
{
    private $controllerName;
    private $actionName;

    /**
     * View constructor.
     * @param $controllerName
     * @param $actionName
     */
    public function __construct($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    public function render($viewName = null, $model = null)
    {
        if(null==$viewName || is_object($viewName)){
            $model = $viewName;
            $viewName= $this->controllerName
                . DIRECTORY_SEPARATOR
                . $this->actionName;
        }
        require_once 'Views/'.$viewName.'.php';
    }
}