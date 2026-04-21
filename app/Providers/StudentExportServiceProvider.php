<?php

namespace App\Providers;

use App\Services\StudentExport\StudentExportConcrete\StudentExportServiceExcel;
use App\Services\StudentExport\StudentExportService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class StudentExportServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StudentExportService::class, function(Application $app){
            return new StudentExportServiceExcel(new Spreadsheet());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return [StudentExportService::class];
    }
}
