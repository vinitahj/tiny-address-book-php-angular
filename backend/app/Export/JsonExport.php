<?php

namespace App\Export;

class JsonExport implements ExportFormat
{
    public function export(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
