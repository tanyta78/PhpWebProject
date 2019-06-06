<?php

namespace Core;

use Core\Http\RequestContextInterface;
use Core\ModelBinding\ModelBinderInterface;
use Core\View\View;

class Application
{
    /**
     * @var RequestContextInterface
     */
    private $request;
    /**
     * @var ModelBinderInterface
     */
    private $modelBinder;

    /**
     * Application constructor.
     * @param RequestContextInterface $request
     * @param ModelBinderInterface $modelBinder
     */
    public function __construct(RequestContextInterface $request, ModelBinderInterface $modelBinder)
    {
        $this->request = $request;
        $this->modelBinder = $modelBinder;
    }


    public function start(){
        $controllerName = 'Controllers\\'
            . ucfirst($this->request->getControllerName())
            .'Controller';
        $view = new View($this->request);
        $controller = new $controllerName($view);

        $actionInfo = new \ReflectionMethod(
            $controllerName,
            $this->request->getActionName()
        );

        $pos=-1;
        $internalPos = 0;
        $allParams = [];
        $requestParams = $this->request->getParameters();
        foreach ($actionInfo->getParameters() as $parameter){
            $pos++;
            $classType = $parameter->getClass();
            if (null===$classType){
                $allParams[$pos]=$requestParams[$internalPos];
                $internalPos++;
                continue;
            }
            $className =$classType->getName();
            $bindingModel = $this->modelBinder->bind($_POST,$className);
            $allParams[$pos]=$bindingModel;
        }

        call_user_func_array(
            [
                $controller,
                $this->request->getActionName()
            ],
            $allParams
        );
    }
}