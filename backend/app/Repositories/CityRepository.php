<?php

namespace App\Repositories;

use PDO;

class CityRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Get all cities from the database
    public function getAll()
    {
        $query = "SELECT * FROM cities";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
