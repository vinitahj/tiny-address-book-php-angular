<?php

namespace App\Export;

interface ExportFormat
{
    public function export(array $data);
}
