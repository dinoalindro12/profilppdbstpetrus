<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_subject_id',
        'grade_type',
        'score',
        'academic_year',
        'semester',
        'notes',
        'inputted_by',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacherSubject()
    {
        return $this->belongsTo(TeacherSubject::class);
    }

    public function inputtedBy()
    {
        return $this->belongsTo(User::class, 'inputted_by');
    }
}
