<?php


namespace Controllers;


use Service\User\UserServiceInterface;

class HomeController extends AbstractController
{
    public function index(string $name,UserServiceInterface $userService){
        echo $name."<br/>";
        var_dump($userService);
   }
}