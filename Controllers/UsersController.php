<?php

namespace Controllers;

use Core\View\View;
use Core\View\ViewInterface;
use Models\BindingModels\UserRegisterBindingModel;
use Models\ViewModels\UserProfileViewModel;

class UsersController
{
    /** @var ViewInterface */
    private $view;

    /**
     * UsersController constructor.
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view)
    {
        $this->view = $view;
    }


    public function profile($name)
    {
       $model = new UserProfileViewModel($name);
       $this->view->render($model);
    }

    public function register()
    {
        $this->view->render();
    }

    public function registerProcess(
        UserRegisterBindingModel $model)
    {
        $user = $model->getUsername();
        echo $user;
    }

}