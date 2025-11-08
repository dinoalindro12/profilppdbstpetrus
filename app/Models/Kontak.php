<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;
    
    protected $table = 'contact';
    
    protected $fillable = [
        'email',
        'name',
        'tujuan',
        'subject',
        'message',
        'ip_address',
        'user_agent',
    ];

    // Scope untuk pesan aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Scope untuk pesan dari IP tertentu dalam rentang waktu
    public function scopeRecentFromIp($query, $ip, $hours = 1)
    {
        return $query->where('ip_address', $ip)
                    ->where('created_at', '>=', now()->subHours($hours));
    }
}