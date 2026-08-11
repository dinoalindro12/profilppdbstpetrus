<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'hours_per_week', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }
}
