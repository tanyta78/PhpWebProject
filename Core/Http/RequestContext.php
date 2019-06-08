<?php


namespace Core\Http;


class RequestContext implements RequestContextInterface
{
    private $controllerName;
    private $actionName;
    private $parameters;
    private $queryString;
    private $executingPath;
    private $host;

     /**
     * RequestContext constructor.
     * @param $controllerName
     * @param $actionName
     * @param $parameters
     * @param $queryString
     * @param $executingPath
     * @param $host
     */
    public function __construct($controllerName,
                                $actionName,
                                $parameters,
                                $queryString,
                                $executingPath,
                                $host)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->parameters = $parameters;
        $this->queryString = $queryString;
        $this->executingPath = $executingPath;
        $this->host = $host;
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

    /**
     * @return mixed
     */
    public function getExecutingPath()
    {
        return $this->executingPath;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }
}