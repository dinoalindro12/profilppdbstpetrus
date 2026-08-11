<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // mis. "Matematika", "Bahasa Indonesia"
            $table->string('code')->unique(); // mis. "MAT", "BIND"
            $table->integer('hours_per_week')->default(2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pivot: guru mata pelajaran mengajar mapel tertentu di kelas tertentu
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->string('academic_year');
            $table->timestamps();

            $table->unique(['teacher_id', 'subject_id', 'school_class_id', 'academic_year'], 'teacher_subject_class_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_subjects');
        Schema::dropIfExists('subjects');
    }
};
