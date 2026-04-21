<?php

namespace App\Services\StudentExport;

use PhpOffice\PhpSpreadsheet\Writer\BaseWriter;

interface StudentExportService
{
    public function export(string $format): BaseWriter;
}
