<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\PdoLoginsRepo;
use App\Repositories\LoginsRepository;
use Ramsey\Uuid\Uuid;

class UsersController
{
    private LoginsRepository $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new PdoLoginsRepo();
    }

    public function showLogins(): void
    {
        $users = $this->loginRepository->getAll();

        require_once 'app/Templates/Users/showUserLogin.template.php';
    }

    public function login(): void
    {
        $this->loginRepository->login();
    }

    public function logout(): void
    {
        $this->loginRepository->logout();
        header('Location: /');
    }

    public function register(): void   // atdali validaciju
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

    public function confirmation(): void
    {
        require_once 'app/Templates/Users/confirmation.template.php';
    }

    public function userLogin(): void
    {
        require_once 'app/Templates/Users/loginForm.template.php';
    }

    public function userRegister(): void
    {
        require_once 'app/Templates/Users/passwordFormCheck.php';
    }

    public function loginSuccess(): void
    {
        require_once 'app/Templates/Users/loginSuccess.template.php';
    }
}