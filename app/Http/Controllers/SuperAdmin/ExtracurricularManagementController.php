<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtracurricularManagementController extends Controller
{
    public function index()
    {
        $ekskuls = Extracurricular::orderBy('order')->get();
        return view('super_admin.ekskul.index', compact('ekskuls'));
    }

    public function create()
    {
        return view('super_admin.ekskul.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'mentor' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'schedule' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|max:2048',
            'footer_description' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($request->name);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ekskuls', 'public');
        }

        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('ekskuls', 'public');
        }

        Extracurricular::create($data);

        return redirect()->route('super_admin.ekskul.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $ekskul)
    {
        return view('super_admin.ekskul.edit', compact('ekskul'));
    }

    public function update(Request $request, Extracurricular $ekskul)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'mentor' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'schedule' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|max:2048',
            'footer_description' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ekskuls', 'public');
        }

        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('ekskuls', 'public');
        }

        $ekskul->update($data);

        return redirect()->route('super_admin.ekskul.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $ekskul)
    {
        $ekskul->delete();
        return redirect()->route('super_admin.ekskul.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
