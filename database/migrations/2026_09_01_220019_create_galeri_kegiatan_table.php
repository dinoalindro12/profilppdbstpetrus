<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();       // foto utama album
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // Foto-foto dalam satu kegiatan
        Schema::create('galeri_kegiatan_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galeri_kegiatan_id')
                  ->constrained('galeri_kegiatan')
                  ->cascadeOnDelete();
            $table->string('foto');
            $table->string('keterangan')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_kegiatan_fotos');
        Schema::dropIfExists('galeri_kegiatan');
    }
};
