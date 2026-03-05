<?php

use App\Enums\HomeWorkStatusEnum;
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
        Schema::create('home_work_submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('homework_id')->constrained();

            $table->enum('home_work_status', HomeWorkStatusEnum::cases());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_work_submissions');
    }
};
