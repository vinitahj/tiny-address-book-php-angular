<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactsController extends BaseController
{
    private $entryModel;

    public function __construct()
    {
        parent::__construct();
        $this->entryModel = new Contact($this->db);
    }

    // Return all contacts as JSON
    public function index()
    {
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

        $contacts = $this->entryModel->getAll($offset, $limit);
        echo json_encode($contacts);
    }

    // Receive JSON data to store a new entry
    public function store()
    {
        $data = $this->getPostData();
        $newData = $this->entryModel->create($data);
        echo json_encode(['message' => 'Contact created successfully', 'data' => $newData]);
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
        echo json_encode(['message' => 'Contact updated successfully', 'data' => $updatedData]);
    }

    public function destroy($id)
    {
        $this->entryModel->deleteById($id);
        echo json_encode(['message' => 'Contact Deleted successfully']);
    }

    // Export contacts as per type
    public function export($type)
    {
        $contacts = $this->entryModel->getAll();
        if ($type === 'xml') {
            $xmlData = new \SimpleXMLElement('<?xml version="1.0"?><contacts></contacts>');
            $this->arrayToXml($contacts, $xmlData);
            header('Content-Type: application/xml');
            echo $xmlData->asXML();
        } else {
            echo json_encode($contacts);
        }
    }

    private function arrayToXml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}
