<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index(Request $request)
    {
        $query = Extracurricular::where('is_active', true)->orderBy('order');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $extras = $query->get();
        
        return view('extracurriculars.index', compact('extras'));
    }

    public function show($slug)
    {
        $extra = Extracurricular::with(['achievements.category', 'albums.photos'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $others = Extracurricular::where('id', '!=', $extra->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get();
            
        return view('extracurriculars.show', compact('extra', 'others'));
    }
}
