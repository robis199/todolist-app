<?php

namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;
use App\Config\DBConnect;
use PDO;

class PdoUsersRepo extends DBConnect implements UsersRepository
{
    public function register(User $user): void
    {
        $sql = "INSERT INTO users (user_id, user_name, password, email, gender) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            $user->getId(),
            $user->getName(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getGender()
        ]);
    }

    public function searchUser($email): ?User
    {
        $sql = "SELECT * FROM users WHERE email='{$email}'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $request = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($request === false)
        {
            $user = null;
        } else {
            $user = new User(
                $request["name"],
                $request["gender"],
                $request["email"],
                $request["password"],
                $request["password"],
            );
            $user->setPassword($request["password"]);
        }
        return $user;
    }

}

