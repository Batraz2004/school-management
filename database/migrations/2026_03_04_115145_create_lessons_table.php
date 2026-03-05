<?php

use App\Enums\SemesterEnum;
use App\Enums\WeekDaysEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->enum('semester', SemesterEnum::cases());
            $table->enum('week_day', WeekDaysEnum::cases());
            $table->time('time_start');
            $table->time('time_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
