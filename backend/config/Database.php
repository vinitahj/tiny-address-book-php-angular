<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    private $dbConnection;
    private $dbConn;


    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?? 'localhost';
        $this->dbName = getenv('DB_DATABASE') ?? 'address_book';
        $this->dbUsername = getenv('DB_USERNAME') ?? 'root';
        $this->dbPassword = getenv('DB_PASSWORD') ?? '';
        $this->dbConnection = getenv('DB_CONNECTION') ?? 'mysql';
    }

    public function connect()
    {
        $this->dbConn = null;
        try {
            $connString = $this->dbConnection . ':host=' . $this->host . ';dbname=' . $this->dbName;
            $this->dbConn = new PDO($connString, $this->dbUsername, $this->dbPassword);
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connection Success';
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->dbConn;
    }
}
