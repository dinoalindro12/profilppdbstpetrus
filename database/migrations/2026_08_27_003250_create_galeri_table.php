<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');                        // mis. "Wisuda Angkatan 2024"
            $table->year('angkatan');                       // tahun kelulusan, mis. 2024
            $table->string('cover_image')->nullable();      // foto sampul album
            $table->text('deskripsi')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // Tabel foto individual per album
        Schema::create('galeri_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galeri_id')->constrained('galeri')->cascadeOnDelete();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_fotos');
        Schema::dropIfExists('galeri');
    }
};
