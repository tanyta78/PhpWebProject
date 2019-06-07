<?php

namespace Models\Entity;

class UserDTO
{
    const MAX_FIELD_LENGTH = 255;

    const USERNAME_MIN_LENGTH = 3;
    const PASSWORD_MIN_LENGTH = 6;

    private $id;
    private $username;
    private $password;

    public static function create($username,
                                  $password,
                                  $id = null)
    {

        return (new UserDTO())
            ->setUsername($username)
            ->setPassword($password)
            ->setId($id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): UserDTO
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return UserDTO
     * @throws \Exception
     */
    public function setUsername($username): UserDTO
    {
        PDOValidator::validate(
            self::USERNAME_MIN_LENGTH,
                self::MAX_FIELD_LENGTH,
                $username,
                "Username out of range"
            );

        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): UserDTO
    {
        $this->password = $password;
        return $this;
    }

}