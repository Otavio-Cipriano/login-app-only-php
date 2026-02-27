<?php

namespace App\Domain\Repositories;

use App\Database\Connection;
use App\Domain\Models\User;
use PDO;

class UserRepository
{
    protected PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::Get();
    }

    public function getUser(string $email): User|false
    {
        $stmt = $this->conn->prepare('select * from users where email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) return false;
        return new User($user['id'], $user['email'], $user['password'], $user['name']);
    }

    public function createUser($name, $email, $pass): ?User
    {
        $stmt = $this->conn->prepare('insert into users (name, email, password) value (:name, :email, :password)');
        $stmt->execute(['name'=> $name, 'email' => $email, 'password' => $pass]);
        $id = $this->conn->lastInsertId();

        if($stmt->rowCount() > 0){
            return new User($id, $email, $pass, $name);
        }

        return null;
    }
}