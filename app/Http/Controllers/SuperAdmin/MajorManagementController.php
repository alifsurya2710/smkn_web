<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MajorManagementController extends Controller
{
    public function index()
    {
        $majors = Major::orderBy('order')->get();
        return view('super_admin.jurusan.index', compact('majors'));
    }

    public function create()
    {
        return view('super_admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'nullable|string|max:20',
            'tagline' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'seats' => 'nullable|integer',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'head_of_major' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
            'highlight_title' => 'nullable|string|max:255',
            'highlight_description' => 'nullable|string',
            'highlight_icon' => 'nullable|string|max:255',
            'secondary_color' => 'nullable|string|max:20',
            'curriculum' => 'nullable|array',
            'career_opportunities' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($request->name);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('majors', 'public');
        }

        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('majors', 'public');
        }

        Major::create($data);

        return redirect()->route('super_admin.jurusan.index')->with('success', 'Program Keahlian berhasil ditambahkan.');
    }

    public function edit(Major $jurusan)
    {
        return view('super_admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Major $jurusan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'nullable|string|max:20',
            'tagline' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'seats' => 'nullable|integer',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'head_of_major' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
            'highlight_title' => 'nullable|string|max:255',
            'highlight_description' => 'nullable|string',
            'highlight_icon' => 'nullable|string|max:255',
            'secondary_color' => 'nullable|string|max:20',
            'curriculum' => 'nullable|array',
            'career_opportunities' => 'nullable|array',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('majors', 'public');
        }
        
        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('majors', 'public');
        }

        $jurusan->update($data);

        return redirect()->route('super_admin.jurusan.index')->with('success', 'Program Keahlian berhasil diperbarui.');
    }

    public function destroy(Major $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('super_admin.jurusan.index')->with('success', 'Program Keahlian berhasil dihapus.');
    }
}
