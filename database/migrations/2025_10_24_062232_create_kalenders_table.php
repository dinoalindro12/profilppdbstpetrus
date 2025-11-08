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
        Schema::create('kalenders', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul kalender akademik
            $table->string('file_path'); // Path/lokasi file yang diupload
            $table->string('original_file_name'); // Nama asli file
            $table->string('file_size')->nullable(); // Ukuran file
            $table->string('academic_year'); // Tahun akademik (cth: 2023/2024)
            $table->enum('semester', ['Ganjil', 'Genap', 'Antara']); // Semester
            $table->date('start_date'); // Tanggal mulai efektif
            $table->date('end_date'); // Tanggal berakhir efektif
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->boolean('is_active')->default(false); // Status aktif/tidak
            $table->timestamps();
            $table->softDeletes(); // Untuk arsip jika data dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalenders');
    }
};