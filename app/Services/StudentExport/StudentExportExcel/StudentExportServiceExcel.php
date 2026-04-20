<?php

namespace App\Services\StudentExport\StudentExportExcel;

use App\Enums\ExportFormatsEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use App\Services\StudentExport\StudentExportService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\BaseWriter;

class StudentExportServiceExcel implements StudentExportService
{
    public function __construct(public Spreadsheet $spreadsheet) {}

    public function export(string $format): BaseWriter
    {
        $studentsArr = User::role(RoleEnum::student->value)
            ->with('schoolClasses')
            ->get(['id', 'name', 'email', 'password'])
            ->toArray();

        $spreadsheet = $this->spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();

        // Заголовки столбцов
        $sheet->setCellValue('A1', 'Учебный класс');
        $sheet->setCellValue('B1', 'Фио');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Password');

        $row = 2;
        foreach ($studentsArr as $student) {
            // Извлекаем названия классов из связи (предполагается, что у SchoolClass есть поле 'name')
            $classNames = collect($student['school_classes'] ?? [])->pluck('name')->implode(', ');

            $sheet->setCellValue('A' . $row, $classNames);
            $sheet->setCellValue('B' . $row, $student['name']);
            $sheet->setCellValue('C' . $row, $student['email']); // лучше не выводить пароль
            $sheet->setCellValue('D' . $row, '');

            $row++;
        }

        // Автоширина столбцов (опционально)
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $formatClass = ExportFormatsEnum::tryFrom($format)?->formatType();
        $writer = IOFactory::createWriter($spreadsheet, $formatClass);

        return $writer;
    }
}
