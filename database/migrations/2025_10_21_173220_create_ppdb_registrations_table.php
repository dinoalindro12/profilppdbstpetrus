<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // Nomor pendaftaran otomatis
            $table->foreignId('ppdb_info_id')->constrained('ppdb_infos')->onDelete('cascade'); // Tambahkan 'ppdb_infos' di constrained
            $table->string('full_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->text('address');
            $table->string('phone');
            $table->string('previous_school')->nullable(); // Asal sekolah
            $table->string('father_name');
            $table->string('father_phone')->nullable();
            $table->string('mother_name');
            $table->string('mother_phone')->nullable();
            $table->string('photo')->nullable(); // Foto
            $table->string('birth_certificate')->nullable(); // Akta kelahiran
            $table->string('family_card')->nullable(); // Kartu keluarga
            $table->string('report_card')->nullable(); // Rapor
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable(); // Catatan dari admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};