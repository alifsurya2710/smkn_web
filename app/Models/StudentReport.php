<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes; //, \Spatie\Activitylog\Traits\LogsActivity;

    /*
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['student_id', 'file_name'])
            ->useLogName('rapor');
    }
    */

    protected $fillable = [
        'student_id',
        'nisn',
        'nama',
        'jurusan', // Added
        'semester',
        'academic_year',
        'academic_year_id',
        'grades',
        'teacher_notes',
        'file_path',
        'file_name',
    ];

    protected $casts = [
        'grades' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
