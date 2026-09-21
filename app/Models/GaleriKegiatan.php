<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriKegiatan extends Model
{
    use HasFactory;

    protected $table = 'galeri_kegiatan';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'cover',
        'is_published',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'is_published' => 'boolean',
    ];

    // ── Relasi ──────────────────────────────────────────────────────────
    public function fotos()
    {
        return $this->hasMany(GaleriKegiatanFoto::class)->orderBy('urutan');
    }

    // ── Scope ────────────────────────────────────────────────────────────
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
