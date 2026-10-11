<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbInfo extends Model
{
    use HasFactory;

    protected $table = 'ppdb_infos'; // Ubah menjadi ppdb_infos

    protected $fillable = [
        'academic_year',
        'registration_start',
        'registration_end',
        'requirements',
        'schedule',
        'quota',
        'is_active'
    ];

    protected $casts = [
        'registration_start' => 'date',
        'registration_end' => 'date',
        'is_active' => 'boolean'
    ];

    public function registrations()
    {
        return $this->hasMany(PpdbRegistration::class, 'ppdb_info_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithinRegistrationPeriod($query)
    {
        return $query->where('registration_end', '>=', now()->format('Y-m-d'));
    }

    public function scopeExpired($query)
    {
        return $query->where('registration_end', '<', now()->format('Y-m-d'));
    }

    // Auto-deactivate expired PPDB
    public static function deactivateExpired()
    {
        return self::where('is_active', true)
            ->where('registration_end', '<', now()->format('Y-m-d'))
            ->update(['is_active' => false]);
    }
}