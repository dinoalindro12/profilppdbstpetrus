<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_infos', function (Blueprint $table) { // Ubah menjadi ppdb_infos
            $table->id();
            $table->string('academic_year'); // Tahun ajaran, e.g., 2024/2025
            $table->date('registration_start');
            $table->date('registration_end');
            $table->text('requirements')->nullable(); // Syarat pendaftaran
            $table->text('schedule')->nullable(); // Jadwal lengkap
            $table->integer('quota')->nullable(); // Kuota
            $table->boolean('is_active')->default(false); // Apakah info ini aktif?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_infos'); // Ubah menjadi ppdb_infos
    }
};