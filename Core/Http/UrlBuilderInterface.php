<?php


namespace Core\Http;


interface UrlBuilderInterface
{
    public function build(string $controller = null,
                          string $action = null,
                          ...$params);
}