<?php


namespace Core\View;


use Core\Http\RequestContextInterface;
use Core\Http\UrlBuilderInterface;

class View implements ViewInterface
{
    /** @var RequestContextInterface */
    private $request;
    /**
     * @var UrlBuilderInterface
     */
    private $urlBuilder;

    /**
     * View constructor.
     * @param RequestContextInterface $request
     */
    public function __construct(RequestContextInterface $request,
UrlBuilderInterface $urlBuilder)
    {
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
    }


    public function render($viewName = null, $model = null)
    {
        if(null==$viewName || is_object($viewName)){
            $model = $viewName;
            $viewName= $this->request->getControllerName()
                . DIRECTORY_SEPARATOR
                . $this->request->getActionName();
        }
        require_once 'Views/'.$viewName.'.php';
    }

    public function url($controller, $action, ...$params)
    {
       return $this->urlBuilder->build($controller,$action,$params);
    }
}