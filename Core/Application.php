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

    private $dependencies;

    private $cache;

    /**
     * Application constructor.
     * @param RequestContextInterface $request
     * @param ModelBinderInterface $modelBinder
     */
    public function __construct(RequestContextInterface $request, ModelBinderInterface $modelBinder)
    {
        $this->request = $request;
        $this->modelBinder = $modelBinder;
        $this->dependencies=[];
        $this->cache=[];
    }

    public function addDependencies($interface , $implementation)
    {
        $this->dependencies[$interface] = $implementation;
    }


    public function cache($interface , $obj)
    {
        $this->cache[$interface] = $obj;
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

            $parameter = null;
            if(array_key_exists($className,$this->dependencies)){
                $parameter=$this->resolve($className);
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

    public function resolve($interfaceName)
    {
        if(array_key_exists($interfaceName,$this->cache)){
            return $this->cache[$interfaceName];
        }

        $className=$this->dependencies[$interfaceName];
        $classInfo = new \ReflectionClass($className);
        $ctorInfo = $classInfo->getConstructor();

        if(null==$ctorInfo){
            $obj = new $className();
            $this->cache($className,$obj);
            return $obj;
        }

        $resolvedParameters = [];
        foreach ($ctorInfo->getParameters() as $parameter){
           $resolvedParameters[]= $this->resolve($parameter->getClass()->getName());
        }

        $obj = $classInfo->newInstanceArgs($resolvedParameters);
        $this->cache($interfaceName,$obj);

        return $obj;
    }
}