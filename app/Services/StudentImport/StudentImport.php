<?php

namespace App\Services\StudentImport;

use Illuminate\Http\UploadedFile;

interface StudentImport
{
    public function import(UploadedFile $file): void;
    public function getFailedRecordsByImport(): array;
}
