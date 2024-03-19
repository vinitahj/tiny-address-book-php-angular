<?php

namespace App\Repositories;

use PDO;

class GroupRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    // Get all groups from the database
    public function getAll($offset = 0, $limit = 10)
    {
        $query = "SELECT * FROM groups  ORDER BY id DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Add a new group to the database
    public function create($data)
    {
        $query = "INSERT INTO groups (name, description) VALUES (:name, :description)";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();

        // Get the ID of the last inserted row
        $lastId = $this->db->lastInsertId();
        $newGroup = $this->findById($lastId);
        return $newGroup;
    }

    // Update an existing row
    public function update($data, $id)
    {
        $query = "UPDATE groups SET name = :name, description = :description,  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $updatedGroup = $this->findById($id);
        return $updatedGroup;
    }

    // Get a single group by ID (for editing)
    public function findById($id)
    {
        $query = "SELECT * FROM groups WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a single group by ID (for editing)
    public function deleteById($id)
    {
        $query = "Delete FROM groups WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
