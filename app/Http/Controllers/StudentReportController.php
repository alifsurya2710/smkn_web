<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentReport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    public function index()
    {
        // Check if verified in session
        if (!session('rapor_verified')) {
            return view('rapor.verify');
        }

        $nisn = session('rapor_student_nisn');
        $name = session('rapor_student_name');

        // Allow fetching by User ID if it was set, OR by NISN / Name
        $reports = StudentReport::where(function($query) use ($nisn, $name) {
                $query->where('nisn', $nisn)
                      ->orWhereHas('student', function($q) use ($nisn) {
                          $q->where('nisn', $nisn);
                      });
            })
            ->with('academicYear')
            ->latest()
            ->get();

        return view('rapor.index', compact('reports'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'username' => 'required', // This is Name
            'nisn' => 'required',
        ]);

        // Look for any report that matches this NISN and Name
        $has_report = StudentReport::where('nisn', $request->nisn)
            ->where('nama', 'LIKE', '%' . $request->username . '%')
            ->exists();

        // Also check if they exist as a registered User
        $user = User::where('nisn', $request->nisn)
            ->where('name', 'LIKE', '%' . $request->username . '%')
            ->role('siswa')
            ->first();
        
        if ($has_report || $user) {
            session(['rapor_verified' => true]);
            session(['rapor_student_nisn' => $request->nisn]);
            session(['rapor_student_name' => $request->username]);
            return redirect()->route('e-rapor');
        }

        return back()->with('error', 'Data verifikasi tidak cocok. Silakan cek Nama Lengkap dan NISN Anda.');
    }

    public function logoutRapor()
    {
        session()->forget(['rapor_verified', 'rapor_student_nisn', 'rapor_student_name']);
        return redirect()->route('e-rapor');
    }

    public function upload(Request $request)
    {
        $this->authorize('create', StudentReport::class);

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'file' => 'required|file|mimes:xlsx,xls,pdf|max:5120', // 5MB Limit
        ]);

        $file = $request->file('file');
        $filename = 'rapor_' . $request->student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        // Store in private storage
        $path = $file->storeAs('private/rapor', $filename, 'local');

        StudentReport::create([
            'student_id' => $request->student_id,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return back()->with('success', 'Rapor berhasil diupload ke penyimpanan aman.');
    }

    public function download(StudentReport $report)
    {
        // Allow if super_admin/admin OR if session matches
        $is_admin = Auth::check() && Auth::user()->hasRole(['super_admin', 'admin']);
        $is_owner = session('rapor_student_id') == $report->student_id;

        if (!$is_admin && !$is_owner) {
            abort(403, 'Akses tidak sah.');
        }

        if (!request()->hasValidSignature()) {
            abort(403, 'Tautan unduhan tidak valid atau sudah kedaluwarsa.');
        }

        if (!\Illuminate\Support\Facades\Storage::disk('local')->exists($report->file_path)) {
            abort(404, 'File rapor tidak ditemukan.');
        }

        return \Illuminate\Support\Facades\Storage::disk('local')->download($report->file_path, $report->file_name);
    }
}
