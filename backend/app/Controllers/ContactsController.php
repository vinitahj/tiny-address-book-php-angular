<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Utilities\ExportData;
use App\Export\ExportHandler;
use App\Export\XmlExport;
use App\Export\JsonExport;
use App\Repositories\ContactRepository;

class ContactsController extends BaseController
{
    private $contactModel;

    public function __construct()
    {
        parent::__construct();
        $contactRepository = new ContactRepository($this->db);
        $this->contactModel = new Contact($contactRepository);
    }

    // Return all contacts as JSON
    public function index()
    {
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

        $contacts = $this->contactModel->getAll($offset, $limit);
        echo json_encode($contacts);
    }

    // Receive JSON data to store a new contact
    public function store()
    {
        $data = $this->getPostData();
        $newData = $this->contactModel->create($data);
        echo json_encode(['message' => 'Contact created successfully', 'data' => $newData]);
    }

    // Return a single contact for editing
    public function show($id)
    {
        $contact = $this->contactModel->findById($id);
        echo json_encode($contact);
    }

    // Receive JSON data to update an existing contact
    public function update($id)
    {
        $data = $this->getPostData();
        $updatedData = $this->contactModel->update($data, $id);
        echo json_encode(['message' => 'Contact updated successfully', 'data' => $updatedData]);
    }

    public function destroy($id)
    {
        $this->contactModel->deleteById($id);
        echo json_encode(['message' => 'Contact Deleted successfully']);
    }

    // Export contacts as per type
    public function export($type)
    {
        $contacts = $this->contactModel->getCollection();
        if ($type === 'xml') {
            $xmlExporter = new ExportHandler(new XmlExport('contacts'));
            $xmlExporter->exportData($contacts);
        } else {
            // For JSON export
            $jsonExporter = new ExportHandler(new JsonExport());
            $jsonExporter->exportData($contacts);
        }
    }
}
