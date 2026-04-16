<?php

namespace App\Providers;

use App\Services\StudentImport\StudentImportService;
use App\Services\StudentImport\StudentImportSpreadSheet\StudentImportServiceSpreadSheet;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class StudentImportServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StudentImportService::class, function(Application $app){
            return new StudentImportServiceSpreadSheet();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides(): array
    {
        return [StudentImportService::class];
    }
}
