<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('teacher_subject_id')->constrained('teacher_subjects')->cascadeOnDelete();
            $table->enum('grade_type', ['ulangan_harian', 'uts', 'uas', 'tugas'])->default('ulangan_harian');
            $table->decimal('score', 5, 2);
            $table->string('academic_year');
            $table->tinyInteger('semester')->comment('1 atau 2');
            $table->text('notes')->nullable();
            $table->foreignId('inputted_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
