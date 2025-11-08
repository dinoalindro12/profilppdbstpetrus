<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use App\Models\Extracurricular;
use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Curriculums
        Curriculum::create([
            'name' => 'Kurikulum Merdeka',
            'description' => 'Kurikulum terbaru yang memberikan kebebasan bagi siswa untuk mengembangkan minat dan bakatnya.',
            'file' => null,
            'order' => 1,
            'is_active' => true
        ]);

        Curriculum::create([
            'name' => 'Kurikulum 2013',
            'description' => 'Kurikulum yang berfokus pada pengembangan karakter dan kompetensi siswa.',
            'file' => null,
            'order' => 2,
            'is_active' => true
        ]);

        // Sample Extracurriculars
        Extracurricular::create([
            'name' => 'Pramuka',
            'description' => 'Kegiatan kepramukaan untuk melatih kedisiplinan, kemandirian, dan kepemimpinan siswa.',
            'schedule' => 'Sabtu, 08.00 - 11.00',
            'coach' => 'Bu Siti Aminah, S.Pd',
            'order' => 1,
            'is_active' => true
        ]);

        Extracurricular::create([
            'name' => 'Basket',
            'description' => 'Latihan bola basket untuk mengembangkan kemampuan olahraga dan kerja sama tim.',
            'schedule' => 'Selasa & Kamis, 15.00 - 17.00',
            'coach' => 'Pak Budi Santoso, S.Pd',
            'order' => 2,
            'is_active' => true
        ]);

        // Sample Achievements
        Achievement::create([
            'title' => 'Juara 1 Olimpiade Matematika Tingkat Kota',
            'description' => 'Siswa kami meraih juara 1 dalam Olimpiade Matematika tingkat kota yang diikuti oleh 50 sekolah.',
            'category' => 'Akademik',
            'year' => 2024,
            'level' => 'Kota',
            'order' => 1,
            'is_active' => true
        ]);

        Achievement::create([
            'title' => 'Juara 2 Lomba Pidato Bahasa Inggris',
            'description' => 'Siswi kami meraih juara 2 dalam lomba pidato bahasa Inggris tingkat provinsi.',
            'category' => 'Bahasa',
            'year' => 2024,
            'level' => 'Provinsi',
            'order' => 2,
            'is_active' => true
        ]);
    }
}