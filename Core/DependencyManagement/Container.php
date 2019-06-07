<?php


namespace Core\DependencyManagement;


class Container implements ContainerInterface
{

    private $dependencies;

    private $cache;

    public function resolve($interfaceName)
    {
        if(array_key_exists($interfaceName,$this->cache)){
            return $this->cache[$interfaceName];
        }

        if(interface_exists($interfaceName)){
            $className=$this->dependencies[$interfaceName];
        }else if (class_exists($interfaceName)){
            $className=$interfaceName;
        }else{
            throw new \Exception("Unknown type given!!!");
        }


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

    public function addDependency($interface , $implementation)
    {
        $this->dependencies[$interface] = $implementation;
    }


    public function cache($interface , $obj)
    {
        $this->cache[$interface] = $obj;
    }

    public function exists($interfaceName): bool
    {
        return array_key_exists($interfaceName,$this->dependencies);
    }
}