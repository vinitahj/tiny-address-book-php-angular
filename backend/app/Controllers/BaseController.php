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
            $path =  '../database/setup.sql';
            $sql = file_get_contents($path);
            $sql = str_replace('address_book', getenv('DB_DATABASE'), $sql);
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            echo json_encode(['message' => 'Database and tables created successfully!']);
        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
