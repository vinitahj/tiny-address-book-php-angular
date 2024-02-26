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

    // Export entries as per type
    public function export($type)
    {
        $entries = $this->entryModel->getAll();
        if ($type === 'xml') {
            $xmlData = new \SimpleXMLElement('<?xml version="1.0"?><entries></entries>');
            $this->arrayToXml($entries, $xmlData);
            header('Content-Type: application/xml');
            echo $xmlData->asXML();
        } else {
            echo json_encode($entries);
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
