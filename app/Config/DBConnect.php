<?php

namespace App\Config;

use PDO;

class DBConnect
{
    private string $host = "127.0.0.1";
    private string $username = "roberts";
    private string $password = "robis199";
    private string $database = "todo_list";

    protected function connect(): PDO
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}