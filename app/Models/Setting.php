<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description'
    ];

    // Method untuk mendapatkan nilai setting
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Method untuk menyimpan nilai setting
    public static function setValue($key, $value, $description = null)
    {
        $setting = static::firstOrNew(['key' => $key]);
        $setting->value = $value;
        if ($description) {
            $setting->description = $description;
        }
        $setting->save();
        return $setting;
    }
}