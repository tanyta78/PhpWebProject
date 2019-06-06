<?php


namespace Core\View;


use Core\Http\RequestContextInterface;

class View implements ViewInterface
{
    /** @var RequestContextInterface */
    private $request;

    /**
     * View constructor.
     * @param RequestContextInterface $request
     */
    public function __construct(RequestContextInterface $request)
    {
        $this->request = $request;
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
}