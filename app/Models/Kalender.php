<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kalender extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'file_path',
        'original_file_name',
        'file_size',
        'academic_year',
        'semester',
        'start_date',
        'end_date',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk kalender aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk tahun akademik tertentu
     */
    public function scopeByAcademicYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }

    /**
     * Scope untuk semester tertentu
     */
    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    /**
     * Scope untuk kalender yang sedang berjalan
     */
    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    /**
     * Aktifkan kalender ini dan nonaktifkan yang lain
     */
    public function activate()
    {
        // Nonaktifkan semua kalender lainnya
        self::where('id', '!=', $this->id)->update(['is_active' => false]);
        
        // Aktifkan kalender ini
        $this->update(['is_active' => true]);
    }

    /**
     * Cek apakah kalender sedang aktif
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Cek apakah kalender sedang berjalan berdasarkan tanggal
     */
    public function isCurrent(): bool
    {
        return now()->between($this->start_date, $this->end_date);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return null;

        $size = (int) $this->file_size;
        if ($size >= 1048576) {
            return round($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            return round($size / 1024, 2) . ' KB';
        } else {
            return $size . ' bytes';
        }
    }

    /**
     * Get storage path for the file
     */
    public function getStoragePathAttribute()
    {
        return storage_path('app/public/' . $this->file_path);
    }

    /**
     * Get public URL for the file
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get semester in lowercase for form selections
     */
    public function getSemesterSlugAttribute()
    {
        return strtolower($this->semester);
    }
}