<?php

namespace App\Imports;

use App\Models\StudentReport;
use App\Models\User;
use App\Models\AcademicYear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentReportsImport implements ToModel, WithHeadingRow
{
    protected $academic_year_id;
    protected $semester;

    public function __construct($academic_year_id = null, $semester = 'Ganjil')
    {
        $this->academic_year_id = $academic_year_id;
        $this->semester = $semester;
    }

    public function model(array $row)
    {
        // Find student by NISN
        $student = User::where('nisn', $row['nisn'])->first();
        
        if (!$student) {
            return null;
        }

        return new StudentReport([
            'student_id' => $student->id,
            'academic_year_id' => $this->academic_year_id,
            'semester' => $row['semester'] ?? $this->semester,
            'teacher_notes' => $row['catatan'] ?? $row['notes'] ?? null,
            'grades' => [], // To be expanded for specific subjects if needed
        ]);
    }
}
