<?php

namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;
use App\Config\DBConnect;



class PdoLoginsRepo extends DBConnect implements LoginsRepository
{


    public function getAll(array $filters = []): UsersCollection
    {

        $statement = $this->connect()->query("SELECT * FROM users");

        $usersCollection = new UsersCollection();


        foreach($statement->fetchAll() as $row){

            $usersCollection->add(new User(
                $row['user_id'],
                $row['user_name'],
                $row['password'],
                $row['email'],
                $row['gender'],

            ));
        }

        return $usersCollection;
    }



    public function register(User $user): void
    {
        $sql = "INSERT INTO users (user_id, user_name, password, email, gender) VALUES ('user_id', 'user_name', 'password', 'email', 'gender')";

        $this->connect()->prepare($sql)->execute([
            'user_id' => $user->getId(),
            'user_name' => $user->getName(),
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'email' => $user->getEmail(),
            'gender' => $user->getGender()
        ]);
    }

    public function login(): void
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "SELECT * FROM users WHERE user_name = 'user_name' AND password = 'password'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            'user_name' => $_POST['user'],
            'password' => $password
        ]);

        if($stmt->rowCount() > 0){
            $_SESSION['user_name'] = $_POST['user'];
            header('Location: /success');
        } else {

            header('Location: /');
        }
    }

    public function logout(): void
    {
        session_destroy();
    }
}

