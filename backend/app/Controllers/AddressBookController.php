<?php

namespace App\Controllers;

use App\Models\Entry;

class AddressBookController extends BaseController
{
    private $entryModel;

    public function __construct()
    {
        parent::__construct();
        $this->entryModel = new Entry($this->db);
    }

    // Return all entries as JSON
    public function index()
    {
        $entries = $this->entryModel->getAll();
        echo json_encode($entries);
    }

    // Receive JSON data to store a new entry
    public function store()
    {
        $data = $this->getPostData();
        $newData = $this->entryModel->create($data);
        echo json_encode(['message' => 'Entry created successfully', 'data' => $newData]);
    }

    // Return a single entry for editing
    public function show($id)
    {
        $entry = $this->entryModel->findById($id);
        echo json_encode($entry);
    }

    // Receive JSON data to update an existing entry
    public function update($id)
    {
        $data = $this->getPostData();
        $updatedData = $this->entryModel->update($data, $id);
        echo json_encode(['message' => 'Entry updated successfully', 'data' => $updatedData]);
    }

    public function destroy($id)
    {
        $this->entryModel->deleteById($id);
        echo json_encode(['message' => 'Entry Deleted successfully']);
    }
}
