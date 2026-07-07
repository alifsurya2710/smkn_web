<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->paginate(10);
        return view('super-admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $majors = \App\Models\Major::where('is_active', true)->get();
        $extracurriculars = \App\Models\Extracurricular::where('is_active', true)->get();
        return view('super-admin.albums.create', compact('majors', 'extracurriculars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|max:2048',
            'category' => 'required|string|in:Events,Sports,Academic,Excursions',
            'is_featured' => 'boolean',
            'major_id' => 'nullable|exists:majors,id',
            'extracurricular_id' => 'nullable|exists:extracurriculars,id',
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . time();
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('albums', 'public');
        }

        $album = Album::create($validated);

        return redirect()->route('super_admin.albums.index')->with('success', 'Album berhasil dibuat. Silakan tambahkan foto.');
    }

    public function edit(Album $album)
    {
        $majors = \App\Models\Major::where('is_active', true)->get();
        $extracurriculars = \App\Models\Extracurricular::where('is_active', true)->get();
        return view('super-admin.albums.edit', compact('album', 'majors', 'extracurriculars'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'category' => 'required|string|in:Events,Sports,Academic,Excursions',
            'is_featured' => 'boolean',
            'major_id' => 'nullable|exists:majors,id',
            'extracurricular_id' => 'nullable|exists:extracurriculars,id',
        ]);

        if ($request->title !== $album->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('albums', 'public');
        }

        $album->update($validated);

        return redirect()->route('super_admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }

        // Delete associated gallery photos
        foreach ($album->photos as $photo) {
            Storage::disk('public')->delete($photo->image);
            $photo->delete();
        }

        $album->delete();

        return redirect()->route('super_admin.albums.index')->with('success', 'Album dan semua foto di dalamnya berhasil dihapus.');
    }

    public function uploadPhotos(Request $request, Album $album)
    {
        $request->validate([
            'photos.*' => 'required|image|max:5120', // Max 5MB per photo
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('gallery/' . $album->slug, 'public');
                
                Gallery::create([
                    'title' => $album->title,
                    'image' => $path,
                    'category' => $album->category,
                    'album_id' => $album->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Foto berhasil diunggah ke album.');
    }
}
