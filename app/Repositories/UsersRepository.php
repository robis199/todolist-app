<?php
namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;

interface UsersRepository
{
    public function getAll(): UsersCollection;
    public function register(User $user): void;
    public function getByGender(string $gender);

}