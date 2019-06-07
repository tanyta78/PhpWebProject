<?php

namespace Service\User;

use Models\BindingModels\UserRegisterBindingModel;

interface UserServiceInterface
{
    public function register(UserRegisterBindingModel $user) : bool;

   /* public function login(string $username, string $password) : ?UserDTO;

    public function currentUser() : ?UserDTO;

    public function update(UserDTO $userDTO) : bool;

    public function isLogged() : bool;*/
}