<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'nip',
        'nis',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ─── Role helpers ───────────────────────────────────────────────────────

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles);
    }

    public function isKepalaSekolah(): bool { return $this->role === 'kepala_sekolah'; }
    public function isAdmin(): bool { return in_array($this->role, ['admin', 'super_admin']); }
    public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
    public function isGuruKelas(): bool { return $this->role === 'guru_kelas'; }
    public function isGuruMapel(): bool { return $this->role === 'guru_mapel'; }
    public function isSiswa(): bool { return $this->role === 'siswa'; }

    public function isStaff(): bool
    {
        return in_array($this->role, ['kepala_sekolah', 'admin', 'super_admin', 'guru_kelas', 'guru_mapel']);
    }

    public function dashboardRoute(): string
    {
        return match ($this->role) {
            'kepala_sekolah' => 'dashboard.kepala_sekolah',
            'admin', 'super_admin' => 'admin.dashboard',
            'guru_kelas'    => 'dashboard.guru_kelas',
            'guru_mapel'    => 'dashboard.guru_mapel',
            'siswa'         => 'dashboard.siswa',
            default         => 'admin.dashboard',
        };
    }

    // ─── Relationships ───────────────────────────────────────────────────────

    /** Kelas yang diwali-kelasi (untuk guru_kelas) */
    public function homeroomClass()
    {
        return $this->hasOne(SchoolClass::class, 'homeroom_teacher_id');
    }

    /** Kelas yang diikuti siswa */
    public function enrolledClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_students', 'student_id', 'school_class_id')
            ->withPivot('academic_year')
            ->withTimestamps();
    }

    /** Penugasan mengajar (teacher_subjects) untuk guru_mapel */
    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class, 'teacher_id');
    }

    /** Jadwal mengajar hari ini (untuk guru_mapel) */
    public function todaySchedules()
    {
        $dayOfWeek = now()->dayOfWeekIso; // 1=Mon, 7=Sun
        // Batasi hanya Senin-Jumat (1-5)
        $schoolDay = min($dayOfWeek, 5);

        return $this->hasManyThrough(
            Schedule::class,
            TeacherSubject::class,
            'teacher_id',
            'teacher_subject_id',
            'id',
            'id'
        )->where('schedules.day_of_week', $schoolDay)
         ->where('schedules.is_active', true)
         ->orderBy('schedules.start_time');
    }

    /** Nilai siswa */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }

    /** Absensi siswa */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
