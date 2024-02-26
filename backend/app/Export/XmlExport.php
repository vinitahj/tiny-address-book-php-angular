<?php

namespace App\Export;

class XmlExport implements ExportFormat
{
    private $rootElement;

    public function __construct($rootElement = 'data')
    {
        $this->rootElement = $rootElement;
    }

    public function export(array $data)
    {
        $xmlData = new \SimpleXMLElement("<?xml version=\"1.0\"?><{$this->rootElement}></{$this->rootElement}>");
        $this->arrayToXml($data, $xmlData);
        header('Content-Type: application/xml');
        echo $xmlData->asXML();
    }

    private function arrayToXml(array $data, \SimpleXMLElement &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $key = is_numeric($key) ? "item$key" : $key;
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars((string)$value));
            }
        }
    }
}
