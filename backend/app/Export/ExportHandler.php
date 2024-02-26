<?php

namespace App\Export;

class ExportHandler
{
    private $format;

    public function __construct(ExportFormat $format)
    {
        $this->format = $format;
    }

    public function exportData(array $data)
    {
        $this->format->export($data);
    }
}
