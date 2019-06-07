<?php

namespace Repository\User;

use Models\BindingModels\UserRegisterBindingModel;
use Models\Entity\UserDTO;

interface UserRepositoryInterface
{
    public function insert(UserRegisterBindingModel $userDTO) : bool;

    public function findOneByUsername(string $username) : ?UserDTO;

    public function findOne(int $id): ?UserDTO;

    public function update(int $id, UserDTO $userDTO) : bool;

}