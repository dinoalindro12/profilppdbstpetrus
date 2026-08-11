<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seed 5 akun test — satu untuk tiap role.
 * Password semua: password
 *
 * | Email                            | Role            | Keterangan              |
 * |----------------------------------|-----------------|-------------------------|
 * | kepsek@smastpetrus.test          | kepala_sekolah  | Lihat ringkasan sekolah |
 * | admin@smastpetrus.test           | admin           | Full CRUD               |
 * | wali.kelas@smastpetrus.test      | guru_kelas      | Wali Kelas 10A          |
 * | guru.matematika@smastpetrus.test | guru_mapel      | Mengajar 10A & 11A      |
 * | siswa@smastpetrus.test           | siswa           | NIS: 2025001, Kelas 10A |
 */
class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAjaran = '2025/2026';

        // ── 1. Kepala Sekolah ────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'kepsek@smastpetrus.test'],
            [
                'name'     => 'Rm. Antonius Widodo, S.Pd., M.M.',
                'password' => Hash::make('password'),
                'role'     => 'kepala_sekolah',
                'phone'    => '08112345001',
                'nip'      => 'KS-2020-001',
                'is_active'=> true,
            ]
        );

        // ── 2. Admin ─────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@smastpetrus.test'],
            [
                'name'     => 'Benedikta Susanti, A.Md.',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '08112345002',
                'nip'      => 'ADM-2021-001',
                'is_active'=> true,
            ]
        );

        // ── 3. Guru Kelas (Wali Kelas 10A) ───────────────────────────────
        $guruKelas = User::updateOrCreate(
            ['email' => 'wali.kelas@smastpetrus.test'],
            [
                'name'     => 'Yohanes Kristianto, S.Pd.',
                'password' => Hash::make('password'),
                'role'     => 'guru_kelas',
                'phone'    => '08112345003',
                'nip'      => 'GK-2019-003',
                'is_active'=> true,
            ]
        );

        // ── 4. Guru Mata Pelajaran (Matematika, 2 kelas) ─────────────────
        $guruMapel = User::updateOrCreate(
            ['email' => 'guru.matematika@smastpetrus.test'],
            [
                'name'     => 'Lucia Margaretha, S.Pd.',
                'password' => Hash::make('password'),
                'role'     => 'guru_mapel',
                'phone'    => '08112345004',
                'nip'      => 'GM-2018-004',
                'is_active'=> true,
            ]
        );

        // ── 5. Siswa ─────────────────────────────────────────────────────
        $siswa = User::updateOrCreate(
            ['email' => 'siswa@smastpetrus.test'],
            [
                'name'     => 'Petrus Alfonsius',
                'password' => Hash::make('password'),
                'role'     => 'siswa',
                'phone'    => '08112345005',
                'nis'      => '2025001',
                'is_active'=> true,
            ]
        );

        // ── Kelas 10A ────────────────────────────────────────────────────
        $kelas10A = SchoolClass::updateOrCreate(
            ['name' => 'Kelas 10A', 'academic_year' => $tahunAjaran],
            [
                'grade_level'         => '10',
                'major'               => 'IPA',
                'homeroom_teacher_id' => $guruKelas->id,
                'capacity'            => 36,
                'is_active'           => true,
            ]
        );

        // ── Kelas 11A (untuk guru mapel, kelas kedua) ────────────────────
        $kelas11A = SchoolClass::updateOrCreate(
            ['name' => 'Kelas 11A', 'academic_year' => $tahunAjaran],
            [
                'grade_level'         => '11',
                'major'               => 'IPA',
                'homeroom_teacher_id' => null,
                'capacity'            => 36,
                'is_active'           => true,
            ]
        );

        // ── Enroll siswa ke Kelas 10A ────────────────────────────────────
        $kelas10A->students()->syncWithoutDetaching([
            $siswa->id => ['academic_year' => $tahunAjaran],
        ]);

        // ── Mata Pelajaran ───────────────────────────────────────────────
        $matematika = Subject::updateOrCreate(
            ['code' => 'MAT'],
            ['name' => 'Matematika', 'hours_per_week' => 4, 'is_active' => true]
        );
        $bahasaInd = Subject::updateOrCreate(
            ['code' => 'BIND'],
            ['name' => 'Bahasa Indonesia', 'hours_per_week' => 3, 'is_active' => true]
        );
        $fisika = Subject::updateOrCreate(
            ['code' => 'FIS'],
            ['name' => 'Fisika', 'hours_per_week' => 3, 'is_active' => true]
        );

        // ── Teacher-Subject assignments ──────────────────────────────────
        // Guru Matematika mengajar MAT di 10A dan 11A
        $ts10A = TeacherSubject::updateOrCreate(
            ['teacher_id' => $guruMapel->id, 'subject_id' => $matematika->id, 'school_class_id' => $kelas10A->id, 'academic_year' => $tahunAjaran],
            []
        );
        $ts11A = TeacherSubject::updateOrCreate(
            ['teacher_id' => $guruMapel->id, 'subject_id' => $matematika->id, 'school_class_id' => $kelas11A->id, 'academic_year' => $tahunAjaran],
            []
        );

        // ── Jadwal (Senin=1, Selasa=2, Rabu=3, Kamis=4, Jumat=5) ────────
        // MAT 10A: Senin 07:00–08:30, Rabu 09:30–11:00
        Schedule::updateOrCreate(
            ['teacher_subject_id' => $ts10A->id, 'day_of_week' => 1, 'academic_year' => $tahunAjaran],
            ['start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R.101', 'is_active' => true]
        );
        Schedule::updateOrCreate(
            ['teacher_subject_id' => $ts10A->id, 'day_of_week' => 3, 'academic_year' => $tahunAjaran],
            ['start_time' => '09:30', 'end_time' => '11:00', 'room' => 'R.101', 'is_active' => true]
        );

        // MAT 11A: Selasa 07:00–08:30, Kamis 10:15–11:45
        Schedule::updateOrCreate(
            ['teacher_subject_id' => $ts11A->id, 'day_of_week' => 2, 'academic_year' => $tahunAjaran],
            ['start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R.201', 'is_active' => true]
        );
        Schedule::updateOrCreate(
            ['teacher_subject_id' => $ts11A->id, 'day_of_week' => 4, 'academic_year' => $tahunAjaran],
            ['start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R.201', 'is_active' => true]
        );

        $this->command->info('✓ Role users seeded:');
        $this->command->table(
            ['Email', 'Role', 'Password'],
            [
                ['kepsek@smastpetrus.test',          'kepala_sekolah', 'password'],
                ['admin@smastpetrus.test',            'admin',          'password'],
                ['wali.kelas@smastpetrus.test',       'guru_kelas',     'password'],
                ['guru.matematika@smastpetrus.test',  'guru_mapel',     'password'],
                ['siswa@smastpetrus.test',             'siswa',          'password'],
            ]
        );
    }
}
