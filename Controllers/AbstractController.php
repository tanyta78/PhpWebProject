<?php


namespace Controllers;


use Core\Http\UrlBuilderInterface;
use Core\View\ViewInterface;

class AbstractController
{
    /** @var ViewInterface */
    private $view;

    /** @var UrlBuilderInterface */
    private $urlBuilder;

    /**
     * AbstractController constructor.
     * @param ViewInterface $view
     * @param UrlBuilderInterface $urlBuilder
     */
    public function __construct(ViewInterface $view, UrlBuilderInterface $urlBuilder)
    {
        $this->view = $view;
        $this->urlBuilder = $urlBuilder;
    }

    protected function render($viewName = null, $model =null){
         $this->view->render($viewName,$model);
    }

    protected function redirect($controller,$action,...$params){
        header("Location: ".$this->urlBuilder->build($controller,$action,$params));
        exit;
    }
}