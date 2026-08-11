<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = [
        'name',
        'grade_level',
        'major',
        'academic_year',
        'homeroom_teacher_id',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function homeroomTeacher()
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_students', 'school_class_id', 'student_id')
            ->withPivot('academic_year')
            ->withTimestamps();
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class, 'school_class_id');
    }

    public function schedules()
    {
        return $this->hasManyThrough(
            Schedule::class,
            TeacherSubject::class,
            'school_class_id',
            'teacher_subject_id'
        );
    }
}
