<?php

namespace App\Config;

use PDO;

class DBConnect
{
    private string $host = "127.0.0.1";
    private string $database = "todo_list";
    private string $username = "roberts";
    private string $password = "robis199";


    protected function connect(): PDO
    {
        $sql = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        $pdo = new PDO($sql, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}