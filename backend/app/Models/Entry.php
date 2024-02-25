<?php

namespace App\Models;

use PDO;

class Entry
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Get all entries from the database
    public function getAll()
    {
        $query = "SELECT e.*, c.name as city_name FROM entries e JOIN cities c ON e.city_id = c.id ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new entry to the database
    public function create($data)
    {
        $query = "INSERT INTO entries (name, first_name, email, street, zip_code, city_id) VALUES (:name, :first_name, :email, :street, :zip_code, :city_id)";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':street', $data['street']);
        $stmt->bindParam(':zip_code', $data['zip_code']);
        $stmt->bindParam(':city_id', $data['city_id']);

        $stmt->execute();

        // Get the ID of the last inserted row
        $lastId = $this->db->lastInsertId();
        $newEntry = $this->findById($lastId);
        return $newEntry;
    }

    // Update an existing row
    public function update($data, $id)
    {
        $query = "UPDATE entries SET name = :name, first_name = :first_name, email = :email, street = :street, zip_code = :zip_code, city_id = :city_id WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':street', $data['street']);
        $stmt->bindParam(':zip_code', $data['zip_code']);
        $stmt->bindParam(':city_id', $data['city_id']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $updatedEntry = $this->findById($id);
        return $updatedEntry;
    }

    // Get a single entry by ID (for editing)
    public function findById($id)
    {
        $query = "SELECT * FROM entries WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a single entry by ID (for editing)
    public function deleteById($id)
    {
        $query = "Delete FROM entries WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
