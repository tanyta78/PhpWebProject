<?php


namespace Core\DependencyManagement;


interface ContainerInterface
{
    public function resolve($interfaceName);

    public function addDependency($interfaceName,
$implementationName);

    public function cache($interfaceName, $obj);

    public function exists($interfaceName):bool;
}