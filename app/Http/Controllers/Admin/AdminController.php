<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Kontak;
use App\Models\PpdbRegistration;
use App\Models\PpdbInfo;
use App\Models\Staff;
use App\Models\Facility;
use App\Models\Curriculum;
use App\Models\Extracurricular;
use App\Models\Achievement;
use App\Models\SchoolClass;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Dispatch ke view dashboard yang sesuai berdasarkan role.
     * Satu route, banyak view — tidak ada bypass role di sini.
     */
    public function dashboard(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return match ($user->role) {
            'kepala_sekolah'        => $this->kepalaSekolahDashboard($user),
            'guru_kelas'            => $this->guruKelasDashboard($user),
            'guru_mapel'            => $this->guruMapelDashboard($user),
            'siswa'                 => $this->siswaDashboard($user),
            default                 => $this->adminDashboard($user),  // admin & super_admin
        };
    }

    // ─── Kepala Sekolah ──────────────────────────────────────────────────────

    private function kepalaSekolahDashboard(User $user): View
    {
        $totalSiswa = User::where('role', 'siswa')->where('is_active', true)->count();
        $totalGuru  = User::whereIn('role', ['guru_kelas', 'guru_mapel'])->where('is_active', true)->count();
        $totalPpdb  = PpdbRegistration::count();

        $ppdbStatus = [
            'pending'  => PpdbRegistration::where('status', 'pending')->count(),
            'approved' => PpdbRegistration::where('status', 'approved')->count(),
            'rejected' => PpdbRegistration::where('status', 'rejected')->count(),
        ];

        $stats = [
            'total_siswa'  => $totalSiswa,
            'total_guru'   => $totalGuru,
            'total_ppdb'   => $totalPpdb,
            'total_berita' => Post::where('is_published', true)->count(),
            'ppdb_status'  => $ppdbStatus,
        ];

        $recentPosts    = Post::latest()->take(5)->get();
        $recentMessages = Kontak::latest()->take(5)->get();

        return view('admin.dashboards.kepala_sekolah', compact('stats', 'recentPosts', 'recentMessages'));
    }

    // ─── Admin / Super Admin ─────────────────────────────────────────────────

    private function adminDashboard(User $user): View
    {
        $stats = [
            'total_siswa'  => User::where('role', 'siswa')->count(),
            'total_guru'   => User::whereIn('role', ['guru_kelas', 'guru_mapel'])->count(),
            'total_ppdb'   => PpdbRegistration::count(),
            'pesan_baru'   => Kontak::latest()->take(99)->count(),
        ];

        // Notifikasi sistem — hal-hal yang perlu perhatian admin
        $notifications = [];
        $pendingPpdb = PpdbRegistration::where('status', 'pending')->count();
        if ($pendingPpdb > 0) {
            $notifications[] = "{$pendingPpdb} pendaftaran PPDB menunggu review.";
        }
        $draftPosts = Post::where('is_published', false)->count();
        if ($draftPosts > 0) {
            $notifications[] = "{$draftPosts} berita masih dalam status draft.";
        }

        $recentRegistrations = PpdbRegistration::latest()->take(5)->get();
        $recentMessages      = Kontak::latest()->take(5)->get();

        return view('admin.dashboards.admin', compact(
            'stats', 'notifications', 'recentRegistrations', 'recentMessages'
        ));
    }

    // ─── Guru Kelas ──────────────────────────────────────────────────────────

    private function guruKelasDashboard(User $user): View
    {
        $homeroomClass = $user->homeroomClass()
            ?->with('students')
            ->first();

        $students       = collect();
        $classStats     = ['total' => 0, 'hadir' => 0, 'izin' => 0, 'alpa' => 0];
        $todayAttendance = [];
        $pendingTasks   = [];

        if ($homeroomClass) {
            $students = $homeroomClass->students()->orderBy('name')->get();
            $classStats['total'] = $students->count();

            $today = today();
            $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
                ->whereDate('date', $today)
                ->get()
                ->keyBy('student_id');

            $todayAttendance = $attendances->mapWithKeys(fn($a) => [$a->student_id => $a->status])->toArray();
            $classStats['hadir'] = $attendances->where('status', 'hadir')->count();
            $classStats['izin']  = $attendances->whereIn('status', ['izin', 'sakit'])->count();
            $classStats['alpa']  = $attendances->where('status', 'alpa')->count();

            // Pending tasks: siswa yang belum ada kehadiran hari ini
            $unrecorded = $students->count() - $attendances->count();
            if ($unrecorded > 0) {
                $pendingTasks[] = "Kehadiran belum lengkap — {$unrecorded} siswa belum dicatat hari ini.";
            }
        }

        return view('admin.dashboards.guru_kelas', compact(
            'homeroomClass', 'students', 'classStats', 'todayAttendance', 'pendingTasks'
        ));
    }

    // ─── Guru Mata Pelajaran ─────────────────────────────────────────────────

    private function guruMapelDashboard(User $user): View
    {
        $dayOfWeek = now()->dayOfWeekIso; // 1=Mon … 7=Sun
        $schoolDay = min($dayOfWeek, 5);  // Sabtu/Minggu → anggap Jumat (kosong)

        // Jadwal HARI INI — query hanya untuk user yang login
        $todaySchedules = Schedule::with([
                'teacherSubject.subject',
                'teacherSubject.schoolClass',
            ])
            ->whereHas('teacherSubject', fn($q) => $q->where('teacher_id', $user->id))
            ->where('day_of_week', $schoolDay)
            ->where('is_active', true)
            ->orderBy('start_time')
            ->get();

        // Jadwal MINGGU INI — semua hari
        $weekSchedules = Schedule::with([
                'teacherSubject.subject',
                'teacherSubject.schoolClass',
            ])
            ->whereHas('teacherSubject', fn($q) => $q->where('teacher_id', $user->id))
            ->whereBetween('day_of_week', [1, 5])
            ->where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('admin.dashboards.guru_mapel', compact('todaySchedules', 'weekSchedules'));
    }

    // ─── Siswa ───────────────────────────────────────────────────────────────

    private function siswaDashboard(User $user): View
    {
        // Kelas aktif siswa
        $myClass = $user->enrolledClasses()
            ->wherePivot('academic_year', $this->currentAcademicYear())
            ->first();

        // Jadwal hari ini dari kelas siswa
        $todaySchedules = collect();
        if ($myClass) {
            $dayOfWeek = min(now()->dayOfWeekIso, 5);
            $todaySchedules = Schedule::with([
                    'teacherSubject.subject',
                    'teacherSubject.teacher',
                ])
                ->whereHas('teacherSubject', fn($q) => $q->where('school_class_id', $myClass->id))
                ->where('day_of_week', $dayOfWeek)
                ->where('is_active', true)
                ->orderBy('start_time')
                ->get();
        }

        // Nilai terbaru
        $recentGrades = Grade::with('teacherSubject.subject')
            ->where('student_id', $user->id)
            ->latest()
            ->take(8)
            ->get();

        // Pengumuman (berita published terbaru)
        $announcements = Post::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('admin.dashboards.siswa', compact(
            'myClass', 'todaySchedules', 'recentGrades', 'announcements'
        ));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function currentAcademicYear(): string
    {
        $year = now()->month >= 7 ? now()->year : now()->year - 1;
        return "{$year}/" . ($year + 1);
    }
}
