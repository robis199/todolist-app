<?php

namespace App\Models\Collections;

use App\Models\User;

class UsersCollection
{
    private array $userLog = [];

    public function __construct(array $users = [])
    {
        foreach($users as $user){
            $this->add($user);
        }
    }

    public function add(User $user): void
    {
        $this->userLog[$user->getId()] = $user;
    }

    public function getUserLog(): array
    {
        return $this->userLog;
    }
}
