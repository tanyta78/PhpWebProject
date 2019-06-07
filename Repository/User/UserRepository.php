<?php

namespace Repository\User;

use Database\DatabaseInterface;
use Models\BindingModels\UserRegisterBindingModel;
use Models\Entity\UserDTO;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function insert(UserRegisterBindingModel $userDTO): bool
    {
        $this->db->query("
            INSERT INTO users(username, password)
            VALUES (?, ?)
        ")->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword()
        ]);

        return true;
    }

    public function findOneByUsername(string $username): ?UserDTO
    {
        return $this->db->query("
            SELECT id, username, password
            FROM users
            WHERE username = ?
        ")->execute([$username])
            ->fetch(UserDTO::class)
            ->current();
    }

    public function findOne(int $id): ?UserDTO
    {
        return $this->db->query("
            SELECT id, username, password
            FROM users
            WHERE id = ?
        ")->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query("
            UPDATE users
            SET 
              username = ?,
              password = ?
            WHERE id = ?
        ")->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $id
        ]);

        return true;
    }

}