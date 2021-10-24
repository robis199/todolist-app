<?php

namespace App\Authentication;


class AuthValidation
{
    private array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function passwordMatch($password, $passwordConfirmation)
    {
        if ($password !== $passwordConfirmation) {
            $this->errors[] = "Passwords do not match";
        }

        if (count($this->errors) > 0) {
            throw new SignUpValidationException();
        }
    }

    public function userValidation($user)
    {
        if(is_null($user))
        {
            $this->errors[] = "The user does not exist";
        }
        if(count($this->errors) > 0)
        {
            throw new SignInValidationExcepion();
        }
    }


    public function passwordValidation($passwordEntered, $passwordSaved)
    {
        if(!password_verify($passwordEntered, $passwordSaved))
        {
            $this->errors[] = "Incorrect password";
        }
        if(count($this->errors) > 0)
        {
            throw new SignInValidationException();
        }
    }
}

   /* public function passwordValidation()
    {
        if ($_POST['password'] < 8 || preg_match('/[A-Z]/', $_POST['password'])) {
            echo "Password must be at least 8 characters long and/or must contain at least one uppercase letter";
        }

        if ($_POST['password'] !== $_POST['passwordVerification']) {
            echo "Passwords are not the same";
        }
    }
}*/