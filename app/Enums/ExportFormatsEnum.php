<?php

namespace App\Enums;

use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

enum ExportFormatsEnum: string
{
    case WRITER_XLSX = 'Xlsx';
    case WRITER_XLS = 'Xls';
    case WRITER_ODS = 'Ods';
    case WRITER_CSV = 'Csv';
    case WRITER_HTML = 'Html';

    public static function labels(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[$case->name] = $case->value;
        }

        return $result;
    }

    public function formatType(): string
    {
        return match ($this) {
            ExportFormatsEnum::WRITER_XLSX => Xlsx::class,
            ExportFormatsEnum::WRITER_XLS => Xls::class,
            ExportFormatsEnum::WRITER_ODS => Ods::class,
            ExportFormatsEnum::WRITER_CSV => Csv::class,
            ExportFormatsEnum::WRITER_HTML => Html::class,
        };
    }
}
