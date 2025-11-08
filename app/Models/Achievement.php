<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'achievements';

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'year',
        'level',
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

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }
}