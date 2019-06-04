<?php

namespace Controllers;

use Models\UserRegisterViewModel;
use Core\View;
use Core\ViewInterface;

class UserController{

    /**
     * @var View
     */
    private $view;
    public function __construct(ViewInterface $view){
        $this->view = $view;
    }

    public function register(string $name)
    {
        $user = new UserRegisterViewModel();
        $user->setId(45);
        $user->setName($name);

       $this->view->render('user_register', $user);
    } 

    public function delete(int $id, string $name)
    {
        $this->view->render('user_delete');
        echo "i am user terminator for user ".$id." and name ".$name;
    }

   
}