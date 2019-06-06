<?php


namespace Core\ModelBinding;


interface ModelBinderInterface
{
    public function bind(array $data,$className);
}