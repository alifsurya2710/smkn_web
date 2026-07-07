<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $majorIds = $user->majors->pluck('id');
        
        $stats = [
            'total_students' => \App\Models\User::role('siswa')
                ->whereIn('major_id', $majorIds)
                ->count(),
            'my_majors' => $user->majors()->count(),
        ];

        return view('guru.dashboard', compact('stats'));
    }
}
