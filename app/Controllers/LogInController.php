<?php

namespace App\Controllers;

use App\Authentication\LogInSession;
use App\Authentication\LogInValidation;
use App\Models\User;
use App\Repositories\PdoUsersRepo;
use Ramsey\Uuid\Uuid;

use Exception;

class LogInController
{
    private PdoUsersRepo $loginRepository;
    private LogInValidation $logInValidation;

    public function __construct()
    {
        $this->loginRepository = new PdoUsersRepo();
        $this->logInValidation = new LogInValidation;
    }

    public function login(): void
    {
        try {
            $this->logInValidation->passwordValidation();
            $this->logInValidation->emptyField();


            if (LogInSession::LOGGED_IN) header('Location: /');

            $user = $this->loginRepository->getByGender($_POST['gender']);

            if ($user !== null && password_verify($_POST['password'], $user->getPassword()))
            {
                $_SESSION['id'] = $user->getId();
                header('Location: /');
            } else {
                header('Location: /login');
            }

        } catch (Exception $e) {
            echo  'Caught exception: ',  $e->getMessage();
        }

    }

    public function logout(): void
    {
        unset($_SESSION['id']);
        header('Location: /');
    }

    public function showLogins(): void
    {
        $users = $this->loginRepository->getAll();

        require_once 'app/Templates/Users/loginForm.template.twig';
    }




    public function register(): void
    {
        if(strlen(trim($_POST['password'])) < 10 || !ctype_lower($_POST['password']) > 35) header('Location: /record');
        if($_POST['password'] !== $_POST['passwordVerification']) header('Location: /record');

        $user = new User(
            Uuid::uuid4(),
            $_POST['user_name'],
            $_POST['password'],
            $_POST['email'],
            $_POST['gender'],
        );

        $this->loginRepository->register($user);
        header('Location: /records');
    }

}