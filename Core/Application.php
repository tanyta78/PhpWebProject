<?php

namespace Core;

use Core\DependencyManagement\ContainerInterface;
use Core\Http\RequestContextInterface;
use Core\ModelBinding\ModelBinderInterface;

class Application implements ApplicationInterface
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
     * @var ContainerInterface
     */
    private $container;


    /**
     * Application constructor.
     * @param RequestContextInterface $request
     * @param ModelBinderInterface $modelBinder
     * @param ContainerInterface $container
     */
    public function __construct(RequestContextInterface $request, ModelBinderInterface $modelBinder, ContainerInterface $container)
    {
        $this->request = $request;
        $this->modelBinder = $modelBinder;
        $this->container = $container;
    }

    public function start(){
        $controllerName = 'Controllers\\'
            . ucfirst($this->request->getControllerName())
            .'Controller';

        $controller = $this->container->resolve($controllerName) ;

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

            $parameter = null;
            if($this->container->exists($className)){
                $parameter=$this->container->resolve($className);
            }else{
                $parameter = $this->modelBinder->bind($_POST,$className);
            }

            $allParams[$pos]=$parameter;
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