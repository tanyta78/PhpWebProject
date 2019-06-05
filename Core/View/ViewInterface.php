<?php


namespace Core\View;


interface ViewInterface
{
    public function render($viewName = null, $model = null);
}