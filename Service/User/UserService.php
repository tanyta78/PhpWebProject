<?php

namespace Service\User;

use Models\BindingModels\UserRegisterBindingModel;
use Models\Entity\UserDTO;
use Repository\User\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterBindingModel $userDTO): bool
    {
       if($userDTO->getPassword() !== $userDTO->getConfirmPassword()){
           return false;
       }

       if(null !== $this->userRepository->findOneByUsername($userDTO->getUsername())){
           return false;
       }

     /*  $this->encryptPassword($userDTO);*/

       return $this->userRepository->insert($userDTO);
    }

   /* public function login(string $username, string $password): ?UserDTO
    {
        $user = $this->userRepository->findOneByUsername($username);

        if(null == $user){
           throw new \Exception("Username not found!");
        }

        $userPasswordHash = $user->getPassword();

        if(false === password_verify($password, $userPasswordHash)){
            throw new \Exception("Invalid password!");
        }

        return $user;
    }

    public function currentUser(): ?UserDTO
    {
        if(!isset($_SESSION['id'])) {
            return null;
        }
        return $this->userRepository->findOne($_SESSION['id']);
    }

    public function update(UserDTO $userDTO): bool
    {
        $user = $this->userRepository->findOneByUsername($userDTO->getUsername());

        if(null !== $user){
            return false;
        }

        $this->encryptPassword($userDTO);
        return $this->userRepository->update($_SESSION['id'], $userDTO);
    }*/

    /**
     * @param UserDTO $userDTO
     */
   /* private function encryptPassword(UserDTO $userDTO): void
    {
        $plainPassword = $userDTO->getPassword();
        $passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $userDTO->setPassword($passwordHash);
    }*/

    public function isLogged(): bool
    {
        if($this->currentUser() === null){
            return false;
        }
        return true;
    }
}