<?php


namespace Core\Http;


interface RequestContextInterface
{
    public function getControllerName();

    public function getActionName();

    public function getParameters();

    public function getQueryString();

}