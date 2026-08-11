<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('schedules');
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_subject_id')->constrained('teacher_subjects')->cascadeOnDelete()
                ->comment('Relasi ke teacher_subjects (guru + mapel + kelas)');
            $table->tinyInteger('day_of_week')->comment('1=Senin, 2=Selasa, ..., 5=Jumat');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable(); // Nomor/nama ruang kelas
            $table->string('academic_year');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
