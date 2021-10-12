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

    public function showUsers(): void
    {
        $users = $this->loginRepository->getAll();

        require_once 'app/Views/Users/showUserLogin.php';
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

    public function register(): void
    {
        if(strlen(trim($_POST['password'])) < 10 || !ctype_lower($_POST['password']) > 35) header('Location: /register');
        if($_POST['password'] !== $_POST['passwordVerification']) header('Location: /register');

        $user = new User(
            Uuid::uuid4(),
            $_POST['username']
        );

        $this->loginRepository->register($user);
        header('Location: /registerSuccessful');
    }

    public function confirmation(): void
    {
        require_once 'app/Views/Users/confirmation.template.php';
    }

    public function userLogin(): void
    {
        require_once 'app/Views/Users/loginForm.template.php';
    }

    public function userRegister(): void
    {
        require_once 'app/Views/Users/passwordFormCheck.php';
    }

    public function loginSuccess(): void
    {
        require_once 'app/Views/Users/loginSuccess.template.php';
    }
}