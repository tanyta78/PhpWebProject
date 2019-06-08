<?php

namespace Controllers;

use Models\BindingModels\UserRegisterBindingModel;
use Models\ViewModels\UserProfileViewModel;
use Service\User\UserServiceInterface;

class UsersController extends AbstractController
{
    public function profile($name)
    {
       $model = new UserProfileViewModel($name);
       $this->render($model);
    }

    public function register()
    {
        $this->render();
    }

    public function registerProcess(
       UserRegisterBindingModel $bindingModel,
       UserServiceInterface $userService)
    {
        $userService->register($bindingModel);
        $this->redirect("home","index", $bindingModel->getUsername());
    }

}