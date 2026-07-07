<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_students' => \App\Models\User::role('siswa')->count(),
            'total_ppdb' => \App\Models\PpdbApplication::count(),
            'total_reports' => \App\Models\StudentReport::count(),
            'total_facilities' => \App\Models\Facility::count(),
        ];

        $recent_ppdb = \App\Models\PpdbApplication::latest()->take(5)->get();
        $recent_reports = \App\Models\StudentReport::with('student')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_ppdb', 'recent_reports'));
    }

    public function ppdb()
    {
        $applications = \App\Models\PpdbApplication::with(['firstChoiceMajor', 'secondChoiceMajor'])->latest()->paginate(15);
        return view('admin.ppdb.index', compact('applications'));
    }

    public function eRapor()
    {
        $reports = \App\Models\StudentReport::with(['student.major', 'academicYear'])->latest()->paginate(15);
        return view('admin.e-rapor.index', compact('reports'));
    }
}
