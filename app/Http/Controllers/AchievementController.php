<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Achievement;
use App\Models\PrestasiCategory;
use App\Models\Extracurricular;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::with(['category', 'extracurricular'])->latest()->paginate(10);
        return view('super-admin.prestasi.index', compact('achievements'));
    }

    public function indexPublic()
    {
        $achievements = Achievement::with('category')->latest()->paginate(12);
        return view('school.prestasi-index', compact('achievements'));
    }

    public function showPublic($id)
    {
        $achievement = Achievement::with(['category', 'extracurricular'])->findOrFail($id);
        
        $otherAchievements = Achievement::where('id', '!=', $id)
            ->with('category')
            ->latest()
            ->take(3)
            ->get();
            
        return view('school.prestasi-detail', compact('achievement', 'otherAchievements'));
    }

    public function create()
    {
        $categories = PrestasiCategory::all();
        $extracurriculars = Extracurricular::where('is_active', true)->orderBy('name')->get();
        return view('super-admin.prestasi.create', compact('categories', 'extracurriculars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:prestasi_categories,id',
            'extracurricular_id' => 'nullable|exists:extracurriculars,id',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('achievements', 'public');
        }
        
        // Ensure extracurricular_id is null if not selected
        if (empty($data['extracurricular_id'])) {
            $data['extracurricular_id'] = null;
            
            // Note: Since 'year' is logically needed for the extracurricular page filter 
            // and the database doesn't auto-extract it, we should ensure it's generated if a date exists
            if (!empty($data['date'])) {
                $data['year'] = date('Y', strtotime($data['date']));
            }
        } else {
            // Similarly extract year if date exists
            if (!empty($data['date'])) {
                $data['year'] = date('Y', strtotime($data['date']));
            }
        }

        Achievement::create($data);

        return redirect()->route('super_admin.prestasi.index')->with('success', 'Prestasi Berhasil Ditambah!');
    }

    public function edit(Achievement $prestasi)
    {
        $categories = PrestasiCategory::all();
        $extracurriculars = Extracurricular::where('is_active', true)->orderBy('name')->get();
        return view('super-admin.prestasi.edit', ['achievement' => $prestasi, 'categories' => $categories, 'extracurriculars' => $extracurriculars]);
    }

    public function update(Request $request, Achievement $prestasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:prestasi_categories,id',
            'extracurricular_id' => 'nullable|exists:extracurriculars,id',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();
        
        // Ensure extracurricular_id is null if not selected
        if (empty($data['extracurricular_id'])) {
            $data['extracurricular_id'] = null;
        }
        
        // Extract year if date exists
        if (!empty($data['date'])) {
            $data['year'] = date('Y', strtotime($data['date']));
        }
        
        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // If the old image exists in storage, delete it to save space
            if ($prestasi->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($prestasi->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($prestasi->image);
            }
            $data['image'] = $request->file('image')->store('achievements', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('super_admin.prestasi.index')->with('success', 'Prestasi Berhasil Diperbarui!');
    }

    public function destroy(Achievement $prestasi)
    {
        $prestasi->delete();
        return back()->with('success', 'Prestasi Berhasil Dihapus!');
    }
}
