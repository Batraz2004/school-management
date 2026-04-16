<?php

namespace App\Services\StudentImport\StudentImportSpreadSheet;

use App\Enums\RoleEnum;
use App\Models\SchoolClass;
use App\Models\User;
use App\Services\StudentImport\StudentImportService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class StudentImportServiceSpreadSheet implements StudentImportService
{
    public function __construct() {}

    private array $failedsByImport = [];

    public function import(UploadedFile $file): void
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
            $studentSheet = $spreadsheet->getSheet(0);

            $studentSheetArr = $studentSheet->toArray();
            unset($studentSheetArr[0]); //заголовки не нужны

            //форматирование ключей в более читабильный вид и групирвока по этим ключам
            $studentsByClasses = $this->formatingKeysFromIdToSlug($studentSheetArr);

            //создание учебных годов, классов и студентов:
            foreach ($studentsByClasses as $class => $students) {
                $schoolClass = SchoolClass::query()->firstWhere(['name' => $class]);

                if (blank($schoolClass)) {
                    $this->failedsByImport[] = "класс $class";

                    Log::debug('произошла ошибка', [
                        'контекст' => "учебынй ккласс $class не сушествует",
                    ]);

                    continue;
                }

                foreach ($students as $student) {
                    try {
                        DB::transaction(function () use ($schoolClass, $student) {
                            /** @var User $user*/
                            $user = $schoolClass
                                ->users()
                                ->updateOrCreate(['name' => $student['name']], $student);

                            $student = $user->assignRole(RoleEnum::student->value);
                        });
                    } catch (Throwable $th) {
                        $studentName = "{$student['name']} {$schoolClass->name}";

                        $this->failedsByImport[] = "ученик $studentName";

                        Log::debug('произошла ошибка', [
                            'контекст' => "при импорте ученика $studentName",
                            'код ошибки' => $th->getCode(),
                            'текст ошибки' => $th->getMessage(),
                            'номер строки' => $th->getLine(),
                        ]);
                    }
                }
            }
    }

    private function formatingKeysFromIdToSlug(array $data): array
    {
        $result = [];

        foreach ($data as $val) {
            $valueKey = $val[0];
            unset($val[0]);

            $val['name'] = $val[1];
            $val['email'] = $val[2];
            $val['password'] = $val[3];

            unset($val[1]);
            unset($val[2]);
            unset($val[3]);

            $result[$valueKey][] = $val;
        }

        return $result;
    }

    public function getFailedRecordsByImport(): array
    {
        return $this->failedsByImport;
    }
}
