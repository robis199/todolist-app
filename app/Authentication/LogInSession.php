<?php

namespace App\Authentication;


use App\Models\User;
use App\Repositories\PdoUsersRepo;

class LogInSession
{

    private User $user;
    private string $status;

    public const LOGGED_IN = 'session started';
    public const LOGGED_OUT = 'session finished';

    private const STATUS = [
        self::LOGGED_IN,
        self::LOGGED_OUT,
    ];

    public function __construct(

        ?string $status = null

    )
    {

        $this->setStatus($status ?? LogInSession::LOGGED_IN);

    }


    public function setStatus(string $status): void
    {

        if (($_SESSION['id']::STATUS) !== null)
        {
            return;


        }
        $this->status = $status;


    }




public static function getOne(): ?User
{
if (!self::LOGGED_IN) return null;

$loginRepository = new PdoUsersRepo();

return $loginRepository->getById($_SESSION['id']);
}
}