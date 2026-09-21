<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SambutanKepsek extends Model
{
    //
    use HasFactory;
    protected $table = 'sambutankepsek';
    protected $fillable = [
        'slug',
        'title',
        'nama_kepsek',
        'image',
        'content',
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($galeri) {
            if (empty($galeri->slug)) {
                $galeri->slug = static::generateUniqueSlug($galeri->title);
            }
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('title') && empty($galeri->slug)) {
                $galeri->slug = static::generateUniqueSlug($galeri->title);
            }
        });
    }

    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // supaya Laravel otomatis pakai slug, bukan id, untuk route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

