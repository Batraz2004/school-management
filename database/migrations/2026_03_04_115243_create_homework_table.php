<?php

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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
 
            $table->string('name');
            $table->text('description');

            $table->foreignId('school_class_id')->constrained();
            $table->foreignId('teacher_id')->constrained('users');
            $table->foreignId('subject_id')->constrained();

            $table->date('start_day');
            $table->date('last_day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
