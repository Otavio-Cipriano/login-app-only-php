<?php

namespace App\Database;

require __DIR__ . '/../Config/config.php';

use PDO, PDOException;

class Connection
{
    public static function Get(): null | PDO
    {
        $host = $_ENV['DB_HOST'] ?? DB_HOST;
        $name = $_ENV['DB_NAME'] ?? DB_NAME;
        $user = $_ENV['DB_USER']?? DB_USER;
        $pass = $_ENV['DB_PASS']?? DB_PASS;

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
}