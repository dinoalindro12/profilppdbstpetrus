<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // mis. "Kelas 10A", "Kelas 11 IPA"
            $table->string('grade_level'); // mis. "10", "11", "12"
            $table->string('major')->nullable(); // IPA, IPS, Bahasa
            $table->string('academic_year'); // mis. "2025/2026"
            $table->foreignId('homeroom_teacher_id')->nullable()->constrained('users')->nullOnDelete()
                ->comment('Guru wali kelas (guru_kelas)');
            $table->integer('capacity')->default(36);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pivot: siswa ke kelas
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('academic_year');
            $table->timestamps();

            $table->unique(['school_class_id', 'student_id', 'academic_year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('school_classes');
    }
};
