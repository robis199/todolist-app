<?php

namespace App\Controllers;

use App\Authentication\AuthValidation;
use App\Exceptions\SignUpValidationException;
use App\Exceptions\SignInValidationException;
use App\Models\User;
use App\Repositories\PdoUsersRepo;
use Ramsey\Uuid\Uuid;
use App\View;
use App\Redirect;

class AuthController
{
    private PdoUsersRepo $userRepository;
    private AuthValidation $authValidation;

    public function __construct()
    {
        $this->userRepository = new PdoUsersRepo();
        $this->authValidation = new AuthValidation;
    }

    public function loginForm(): View
    {
        (!empty($_SESSION["errors"])) ? $errors = $_SESSION["errors"] : $errors = [];
        $view = new View("sign-in.view.twig", ["errors" => $errors]);
        return $view;
    }

    public function login()
    {
        if (isset($_POST["sign-in"]))
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $this->userRepository->searchUser($email);

            try {
                $this->authValidation->userValidation($user);
            } catch (SignInValidationException $error) {
                $_SESSION["errors"] = $this->authValidation->getErrors();
                Redirect::url("/login");
                exit;
            }

            try {
                $this->authValidation->passwordValidation($password, $user->getPassword());
                $_SESSION["user-name"] = $user->getName();
                $_SESSION["email"] = $user->getEmail();
                header("/welcome");
            } catch (SignInValidationException $error) {
                $_SESSION["errors"] = $this->authValidation->getErrors();
                header("/login");
                exit;
            }
        }
    }

    public function logInSuccessful()
    {
        return new View("welcome.view.twig", ["user" => $_SESSION["user-name"]]);
    }

    public function userInfo(): View
    {
        return new View("user.view.twig", [
            "userName" => $_SESSION["user-name"],
            "userEmail" => $_SESSION["email"]
        ]);
    }


    public function registrationForm()
    {
        (!empty($_SESSION["errors"])) ? $errors = $_SESSION["errors"] : $errors = [];
        $view = new View("registration.view.twig", ["errors" => $errors]);
        return $view;
    }

    public function register(): void
    {
        if (isset($_POST["register"])) {
            try {
                $this->authValidation->passwordMatch($_POST["pasword1"], $_POST["pasword2"]);
                $user = new User(
                    Uuid::uuid4(),
                    $_POST['user_name'],
                    $_POST['password'],
                    $_POST['email'],
                    $_POST['gender'],
                );

                $this->userRepository->register($user);
                Redirect::url("/login");

            } catch (SignUpValidationException $error) {
                $_SESSION["errors"] = $this->authValidation->getErrors();
                Redirect::url("/registration");
                exit;
            }

        }

    }


    public function logout(): void
    {
        if(isset($_POST["logout"]))
        {
            unset($_SESSION['user_name']);
            unset($_SESSION['email']);
            unset($_SESSION['gemder']);
            header('Location: /sign-in');
        }
    }
}
