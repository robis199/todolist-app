<?php

namespace App\Authentication;


class LogInValidation
{


    public function emptyField(): void
    {
        if (!isset($_POST['username']) ) {
            echo "Username is required";
        }

        if (!isset($_POST['email'])) {
            echo "Email is required";
        }

        if (!isset($_POST['password'])) {
            echo "Password is required";
        }
    }

    public function passwordValidation()
    {
        if ($_POST['password'] < 8 || preg_match('/[A-Z]/', $_POST['password'])) {
            echo "Password must be at least 8 characters long and/or must contain at least one uppercase letter";
        }

        if ($_POST['password'] !== $_POST['passwordVerification']) {
            echo "Passwords are not the same";
        }
    }
}