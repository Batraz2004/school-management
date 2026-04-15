<?php

namespace App\Providers;

use App\Services\StudentImport\StudentImport;
use App\Services\StudentImport\StudentImportSpreadSheet\StudentImportSpreadSheet;
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
        $this->app->singleton(StudentImport::class, function(Application $app){
            return new StudentImportSpreadSheet();
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
        return [StudentImport::class];
    }
}
