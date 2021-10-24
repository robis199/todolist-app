<?php

namespace App\Models;

class User
{
    private string $id;
    private string $name;
    private string $password;
    private string $email;
    private string $gender;

    public function __construct(string $id, string $name, string $password, string $email, string $gender)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
        $this->gender = $gender;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getGender(): string
    {
        return $this->gender;
    }


}