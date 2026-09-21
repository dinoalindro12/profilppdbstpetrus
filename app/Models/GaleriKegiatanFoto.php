<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriKegiatanFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_kegiatan_fotos';

    protected $fillable = ['galeri_kegiatan_id', 'foto', 'keterangan', 'urutan'];

    public function galeriKegiatan()
    {
        return $this->belongsTo(GaleriKegiatan::class);
    }
}
