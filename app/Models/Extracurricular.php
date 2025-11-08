<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'extracurriculars';

    protected $fillable = [
        'name',
        'description',
        'image',
        'schedule',
        'coach',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}