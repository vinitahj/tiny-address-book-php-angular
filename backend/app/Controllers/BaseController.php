<?php

namespace App\Controllers;

use Config\Database;
use Exception;

class BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->setJsonHeader();
    }

    protected  function setJsonHeader()
    {
        header('Content-Type: application/json');
    }

    protected function getPostData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function index()
    {
        echo json_encode(['message' => 'Welcome to Address Book Application API']);
    }

    public function migrate()
    {
        try {
            // get SQL files
            $setupPath = '../database/migrate.sql';
            $dataPath = '../database/seed.sql';

            // Read the contents of the SQL files
            $setupSql = file_get_contents($setupPath);
            $dataSql = file_get_contents($dataPath);

            // Combine the SQL commands
            $sql = $setupSql . "\n" . $dataSql;

            // Replace the placeholder database name with the actual name from the .env file
            $sql = str_replace('address_book', getenv('DB_DATABASE'), $sql);

            // Prepare and execute the SQL
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            echo json_encode(['message' => 'Tables Created and Test Data Added Successfully!']);
        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
