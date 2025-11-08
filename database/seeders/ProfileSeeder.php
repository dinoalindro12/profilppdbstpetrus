<?php

namespace Database\Seeders;

use App\Models\SchoolHistory;
use App\Models\VisionMission;
use App\Models\Staff;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Sejarah Sekolah
        SchoolHistory::create([
            'content' => "Sekolah Kita didirikan pada tahun 2000 dengan visi untuk memberikan pendidikan berkualitas kepada masyarakat. Awalnya sekolah ini hanya memiliki 5 ruang kelas dan 15 guru. Seiring berjalannya waktu, sekolah terus berkembang dan sekarang telah menjadi salah satu sekolah unggulan di kota ini.\n\nPada tahun 2005, sekolah melakukan ekspansi dengan membangun gedung baru dan menambah fasilitas seperti laboratorium komputer dan perpustakaan. Tahun 2010, sekolah mulai menerapkan kurikulum berbasis teknologi untuk mempersiapkan siswa menghadapi era digital.\n\nHingga saat ini, Sekolah Kita terus berkomitmen memberikan pendidikan terbaik dan telah meluluskan ribuan siswa yang berhasil dalam berbagai bidang.",
            'image' => null
        ]);

        // Visi Misi
        VisionMission::create([
            'vision' => "Menjadi sekolah unggulan yang mencetak generasi berakhlak mulia, cerdas, dan berprestasi.",
            'mission' => "1. Menyelenggarakan pendidikan yang berkualitas\n2. Membentuk karakter siswa yang berakhlak mulia\n3. Mengembangkan potensi siswa secara optimal\n4. Menciptakan lingkungan belajar yang nyaman dan inspiratif\n5. Membangun kerjasama dengan orang tua dan masyarakat"
        ]);

        // Sample Teachers
        Staff::create([
            'name' => 'Dr. John Doe, M.Pd',
            'nip' => '196512312001011001',
            'position' => 'Kepala Sekolah',
            'type' => 'teacher',
            'description' => 'Memimpin sekolah sejak tahun 2015 dengan pengalaman 25 tahun di bidang pendidikan.',
            'order' => 1,
            'is_active' => true
        ]);

        Staff::create([
            'name' => 'Jane Smith, S.Pd',
            'nip' => '197803122005012001',
            'position' => 'Guru Matematika',
            'type' => 'teacher',
            'description' => 'Spesialis dalam pengajaran matematika dengan pendekatan yang menyenangkan.',
            'order' => 2,
            'is_active' => true
        ]);

        // Sample Facilities
        Facility::create([
            'name' => 'Laboratorium Komputer',
            'description' => 'Laboratorium komputer dengan 40 unit komputer terbaru, dilengkapi dengan akses internet cepat untuk mendukung pembelajaran teknologi.',
            'order' => 1,
            'is_active' => true
        ]);

        Facility::create([
            'name' => 'Perpustakaan',
            'description' => 'Perpustakaan dengan koleksi lebih dari 10.000 buku dari berbagai bidang ilmu, ruang baca yang nyaman, dan sistem digital.',
            'order' => 2,
            'is_active' => true
        ]);
    }
}