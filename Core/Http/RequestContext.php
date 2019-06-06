<?php


namespace Core\Http;


class RequestContext implements RequestContextInterface
{
    private $controllerName;
    private $actionName;
    private $parameters;
    private $queryString;

    /**
     * RequestContext constructor.
     * @param $controllerName
     * @param $actionName
     * @param $parameters
     * @param $queryString
     */
    public function __construct($controllerName, $actionName, $parameters, $queryString)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->parameters = $parameters;
        $this->queryString = $queryString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->queryString;
    }


}