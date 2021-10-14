<?php

namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;
use App\Config\DBConnect;
use PDO;



class PdoUsersRepo extends DBConnect implements UsersRepository
{

    public function getById(string $id): ?User
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([$id]);

        $user = $statement->fetch();

        return $this->getOne($user);
    }


    public function getAll(): UsersCollection
    {

        $statement = $this->connect()->query("SELECT * FROM users");
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        $usersCollection = new UsersCollection();


        foreach($users as $user){

            $usersCollection->add(new User(
                $user['user_id'],
                $user['user_name'],
                $user['password'],
                $user['email'],
                $user['gender'],

            ));
        }

        return $usersCollection;
    }



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

    public function getByGender(string $gender): ?User
    {
        $sql = "SELECT * FROM users WHERE gender = ?";
        $statement = $this->connect()->prepare($sql);
        $statement->execute([$gender]);

        $user = $statement->fetch();

        return $this->getOne($user);
    }

    private function getOne(array $user): User
    {
        return new user(
            $user['user_id'],
            $user['user_name'],
            $user['email'],
            $user['password'],
            $user['gender'],
        );
    }


}

