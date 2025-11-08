<?php

namespace Database\Seeders;

use App\Models\PpdbInfo;
use Illuminate\Database\Seeder;

class PpdbSeeder extends Seeder
{
    public function run(): void
    {
        // Sample PPDB Info
        PpdbInfo::create([
            'academic_year' => '2024/2025',
            'registration_start' => '2024-01-15',
            'registration_end' => '2024-07-30',
            'requirements' => "1. Fotokopi akta kelahiran\n2. Fotokopi kartu keluarga\n3. Pas foto 3x4 (2 lembar)\n4. Fotokopi rapor kelas 5 dan 6\n5. Surat keterangan lulus/sekolah asal",
            'schedule' => "1. Pendaftaran: 15 Januari - 30 Juli 2024\n2. Tes Seleksi: 5 Agustus 2024\n3. Pengumuman: 10 Agustus 2024\n4. Daftar Ulang: 12-15 Agustus 2024",
            'quota' => 120,
            'is_active' => true
        ]);
    }
}