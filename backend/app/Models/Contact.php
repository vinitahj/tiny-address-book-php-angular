<?php

namespace App\Models;

use PDO;

class Contact
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Get all contacts from the database
    public function getAll($offset = 0, $limit = 10)
    {
        $query = "SELECT e.*, c.name as city_name FROM contacts e JOIN cities c ON e.city_id = c.id ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);

        // Bind limit and offset parameters
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new entry to the database
    public function create($data)
    {
        $query = "INSERT INTO contacts (name, first_name, email, street, zip_code, city_id) VALUES (:name, :first_name, :email, :street, :zip_code, :city_id)";
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
        $newContact = $this->findById($lastId);
        return $newContact;
    }

    // Update an existing row
    public function update($data, $id)
    {
        $query = "UPDATE contacts SET name = :name, first_name = :first_name, email = :email, street = :street, zip_code = :zip_code, city_id = :city_id WHERE id = :id";
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

        $updatedContact = $this->findById($id);
        return $updatedContact;
    }

    // Get a single entry by ID (for editing)
    public function findById($id)
    {
        $query = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a single entry by ID (for editing)
    public function deleteById($id)
    {
        $query = "Delete FROM contacts WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
