<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $table = 'ppdb_registrations';

    protected $fillable = [
        'registration_number',
        'ppdb_info_id',
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'phone',
        'previous_school',
        'father_name',
        'father_phone',
        'mother_name',
        'mother_phone',
        'photo',
        'birth_certificate',
        'family_card',
        'report_card',
        'status',
        'notes'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function info()
    {
        return $this->belongsTo(PpdbInfo::class, 'ppdb_info_id');
    }

    // Generate registration number
    public static function generateRegistrationNumber()
    {
        $year = date('Y');
        $month = date('m');
        $lastRegistration = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();

        $number = 1;
        if ($lastRegistration) {
            $lastNumber = intval(substr($lastRegistration->registration_number, -4));
            $number = $lastNumber + 1;
        }

        return 'PPDB' . $year . $month . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}