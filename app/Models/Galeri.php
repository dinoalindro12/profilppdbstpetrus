<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'slug',
        'title',
        'angkatan',
        'cover_image',
        'deskripsi',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'angkatan'     => 'integer',
    ];

    // ── Boot: auto-generate slug ─────────────────────────────────────────
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($galeri) {
            if (empty($galeri->slug)) {
                $galeri->slug = static::generateUniqueSlug($galeri->title . ' ' . $galeri->angkatan);
            }
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('title') && empty($galeri->slug)) {
                $galeri->slug = static::generateUniqueSlug($galeri->title . ' ' . $galeri->angkatan);
            }
        });
    }

    protected static function generateUniqueSlug(string $text): string
    {
        $slug     = Str::slug($text);
        $original = $slug;
        $count    = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // ── Relationships ─────────────────────────────────────────────────────
    public function fotos()
    {
        return $this->hasMany(GaleriFoto::class)->orderBy('urutan');
    }

    // ── Scopes ────────────────────────────────────────────────────────────
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
