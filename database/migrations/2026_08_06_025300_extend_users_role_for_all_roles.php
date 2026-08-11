<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Extend enum role untuk 5 role baru
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kepala_sekolah','admin','guru_kelas','guru_mapel','siswa','super_admin') DEFAULT 'admin'");

        // Tambahkan kolom tambahan yang belum ada
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable()->after('phone')->comment('Nomor Induk Pegawai untuk guru/staf');
            $table->string('nis')->nullable()->after('nip')->comment('Nomor Induk Siswa');
            $table->string('avatar')->nullable()->after('nis');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nip', 'nis', 'avatar']);
        });
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','super_admin') DEFAULT 'admin'");
    }
};
