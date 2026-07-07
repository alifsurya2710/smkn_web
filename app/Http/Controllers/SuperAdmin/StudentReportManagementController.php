<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use App\Models\User;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentReportManagementController extends Controller
{
    public function index()
    {
        $reports = StudentReport::with(['student.major', 'academicYear'])
            ->latest()
            ->paginate(15);
            
        $academic_years = AcademicYear::orderBy('name', 'desc')->get();
        $majors = \App\Models\Major::all();
        
        return view('super-admin.e-rapor.index', compact('reports', 'academic_years', 'majors'));
    }

    public function recap(Request $request)
    {
        $majors = \App\Models\Major::orderBy('name')->get();
        $academic_years = AcademicYear::orderBy('name', 'desc')->get();
        
        $major_id = $request->get('major_id');
        $academic_year_id = $request->get('academic_year_id');
        $semester = $request->get('semester', 'Ganjil');

        $students = collect();
        if ($major_id && $academic_year_id) {
            $students = User::role('siswa')
                ->where('major_id', $major_id)
                ->with(['reports' => function($query) use ($academic_year_id, $semester) {
                    $query->where('academic_year_id', $academic_year_id)->where('semester', $semester);
                }])
                ->orderBy('name')
                ->get();
        }

        return view('super-admin.e-rapor.recap', compact('students', 'majors', 'academic_years', 'major_id', 'academic_year_id', 'semester'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester' => 'required|string',
            'reports' => 'required|array',
            'reports.*.student_id' => 'required|exists:users,id',
        ]);

        $academic_year_id = $request->academic_year_id;
        $semester = $request->semester;

        foreach ($request->reports as $index => $reportData) {
            if (empty($reportData['teacher_notes']) && !$request->hasFile("reports.$index.file")) {
                continue; // Skip if nothing to save
            }

            $student_id = $reportData['student_id'];
            
            // Find or create report
            $report = StudentReport::where('student_id', $student_id)
                ->where('academic_year_id', $academic_year_id)
                ->where('semester', $semester)
                ->first() ?? new StudentReport();

            $report->student_id = $student_id;
            $report->academic_year_id = $academic_year_id;
            $report->semester = $semester;
            $report->teacher_notes = $reportData['teacher_notes'] ?? $report->teacher_notes;
            $report->grades = $report->grades ?? [];

            if ($request->hasFile("reports.$index.file")) {
                // Delete old file if exists
                if ($report->file_path) {
                    Storage::disk('local')->delete($report->file_path);
                }
                
                $file = $request->file("reports.$index.file");
                $filename = 'rapor_' . $student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('private/rapor', $filename, 'local');
                
                $report->file_path = $path;
                $report->file_name = $file->getClientOriginalName();
            }

            $report->save();
        }

        return redirect()->route('super_admin.rapor.recap', [
            'major_id' => $request->major_id,
            'academic_year_id' => $academic_year_id,
            'semester' => $semester
        ])->with('success', 'Batch rapor berhasil diproses.');
    }

    public function create()
    {
        $students = User::role('siswa')->with('major')->orderBy('name')->get();
        $academic_years = AcademicYear::orderBy('name', 'desc')->get();
        $majors = \App\Models\Major::all();
        
        return view('super-admin.e-rapor.create', compact('students', 'academic_years', 'majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required', // Removed exists constraint
            'nama' => 'nullable|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls|max:10240',
            'teacher_notes' => 'nullable|string',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'academic_year.required' => 'Tahun ajaran wajib diisi.'
        ]);

        // Optional: Find student if account exists
        $student = User::where('nisn', $request->nisn)->first();
        
        // Find or create academic year
        $ay = AcademicYear::firstOrCreate(['name' => $request->academic_year]);

        $data = $request->only(['semester', 'teacher_notes', 'nisn', 'nama', 'jurusan']);
        $data['student_id'] = $student->id ?? null; // Nullable now
        $data['academic_year_id'] = $ay->id;
        $data['academic_year'] = $ay->name;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'rapor_' . ($data['student_id'] ?? $request->nisn) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('private/rapor', $filename, 'local');
            
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
        }

        // Initialize empty grades if not provided
        $data['grades'] = [];

        StudentReport::create($data);

        return redirect()->route('super_admin.rapor.index')->with('success', 'Rapor berhasil ditambahkan.');
    }

    public function edit(StudentReport $rapor)
    {
        $students = User::role('siswa')->with('major')->orderBy('name')->get();
        $academic_years = AcademicYear::orderBy('name', 'desc')->get();
        $majors = \App\Models\Major::all();
        
        return view('super-admin.e-rapor.edit', compact('rapor', 'students', 'academic_years', 'majors'));
    }

    public function update(Request $request, StudentReport $rapor)
    {
        $request->validate([
            'nisn' => 'required', // Removed exists constraint
            'nama' => 'nullable|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls|max:10240',
            'teacher_notes' => 'nullable|string',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'academic_year.required' => 'Tahun ajaran wajib diisi.'
        ]);

        // Optional: Find student if account exists
        $student = User::where('nisn', $request->nisn)->first();

        // Find or create academic year
        $ay = AcademicYear::firstOrCreate(['name' => $request->academic_year]);

        $data = $request->only(['semester', 'teacher_notes', 'nisn', 'nama', 'jurusan']);
        $data['student_id'] = $student->id ?? null;
        $data['academic_year_id'] = $ay->id;
        $data['academic_year'] = $ay->name;

        if ($request->hasFile('file')) {
            // Delete old file
            if ($rapor->file_path) {
                Storage::disk('local')->delete($rapor->file_path);
            }
            
            $file = $request->file('file');
            $filename = 'rapor_' . ($data['student_id'] ?? $request->nisn) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('private/rapor', $filename, 'local');
            
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
        }

        $rapor->update($data);

        return redirect()->route('super_admin.rapor.index')->with('success', 'Rapor berhasil diperbarui.');
    }

    public function destroy(StudentReport $rapor)
    {
        if ($rapor->file_path) {
            Storage::disk('local')->delete($rapor->file_path);
        }
        
        $rapor->delete();
        return back()->with('success', 'Rapor berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:5120',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
        ]);

        // Find or create academic year
        $ay = AcademicYear::firstOrCreate(['name' => $request->academic_year]);
        $academic_year_id = $ay->id;
        $semester = $request->semester;

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), "r");
        
        // Skip header
        fgetcsv($handle, 1000, ",");

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $nisn = $row[0] ?? null; // Assuming first column is NISN
            if (!$nisn) continue;

            $student = User::where('nisn', $nisn)->first();

            StudentReport::create([
                'student_id' => $student->id ?? null,
                'nisn' => $nisn,
                'nama' => $row[1] ?? ($student->name ?? null),
                'jurusan' => $row[2] ?? ($student->major->name ?? null),
                'academic_year_id' => $academic_year_id,
                'semester' => $row[3] ?? $semester,
                'teacher_notes' => $row[4] ?? null,
                'grades' => [],
            ]);
        }

        fclose($handle);

        return back()->with('success', 'Data rapor (CSV) berhasil diimport.');
    }

    public function export()
    {
        $reports = StudentReport::with(['student.major', 'academicYear'])->get();

        $filename = "rekap-rapor-" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // CSV Headings
        fputcsv($handle, ['ID', 'Nama Siswa', 'NISN', 'Jurusan', 'Tahun Ajaran', 'Semester', 'File', 'Catatan', 'Tanggal']);

        foreach ($reports as $report) {
            fputcsv($handle, [
                $report->id,
                $report->student->name ?? '-',
                $report->student->nisn ?? '-',
                $report->student->major->name ?? '-',
                $report->academicYear->name ?? $report->academic_year ?? '-',
                $report->semester,
                $report->file_name ?? '-',
                $report->teacher_notes,
                optional($report->created_at)->format('d-m-Y') ?? '-',
            ]);
        }

        fclose($handle);
        exit();
    }
}
