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
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        $pdo = new PDO($dsn, $this->username, $this->password);

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }


}




//try {
//    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
//    foreach($dbh->query('SELECT * from FOO') as $row) {
//        print_r($row);
//    }
//    $dbh = null;
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage();
//    die();
//}


