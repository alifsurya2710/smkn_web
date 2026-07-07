<?php

namespace App\Exports;

use App\Models\StudentReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentReportsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentReport::with(['student.major', 'academicYear'])->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Siswa',
            'NISN',
            'Jurusan',
            'Tahun Ajaran',
            'Semester',
            'File',
            'Catatan',
            'Dibuat Pada',
        ];
    }

    /**
    * @var StudentReport $report
    * @return array
    */
    public function map($report): array
    {
        return [
            $report->id,
            $report->student->name ?? '-',
            $report->student->nisn ?? '-',
            $report->student->major->name ?? '-',
            $report->academicYear->name ?? $report->academic_year ?? '-',
            $report->semester,
            $report->file_name ?? '-',
            $report->teacher_notes,
            optional($report->created_at)->format('d-m-Y') ?? '-',
        ];
    }
}
