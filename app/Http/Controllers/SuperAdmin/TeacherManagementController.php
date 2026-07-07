<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Imports\TeachersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherManagementController extends Controller
{
    public function index()
    {
        $teachers = User::role('guru')->orderBy('order')->orderBy('name')->paginate(10);
        $profile = \App\Models\SchoolProfile::first() ?? new \App\Models\SchoolProfile();
        return view('super-admin.teachers.index', compact('teachers', 'profile'));
    }

    public function create()
    {
        return view('super-admin.teachers.create');
    }

    public function store(Request $request)
    {
        $existingTeacher = User::role('guru')->where('name', $request->name)->first();
        if ($existingTeacher) {
            return redirect()->back()->withInput()->with('error', 'Guru sudah ada.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255|unique:users',
            'rank' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'is_management' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }
        
        $user = User::create($validated);
        $user->assignRole('guru');

        return redirect()->route('super_admin.teachers.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit(User $teacher)
    {
        return view('super-admin.teachers.edit', compact('teacher'));
    }
    public function update(Request $request, User $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255|unique:users,nip,' . $teacher->id,
            'rank' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'is_management' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()->route('super_admin.teachers.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(User $teacher)
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }
        $teacher->delete();
        return redirect()->route('super_admin.teachers.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new TeachersImport, $request->file('file'));

        return redirect()->route('super_admin.teachers.index')->with('success', 'Data guru berhasil diimport.');
    }

    public function updateHero(Request $request)
    {
        $validated = $request->validate([
            'staff_hero_title' => 'nullable|string|max:255',
            'staff_hero_description' => 'nullable|string',
            'staff_hero_image' => 'nullable|image|max:2048',
        ]);

        $profile = \App\Models\SchoolProfile::first() ?? new \App\Models\SchoolProfile();

        if ($request->hasFile('staff_hero_image')) {
            if ($profile->staff_hero_image) {
                Storage::disk('public')->delete($profile->staff_hero_image);
            }
            $validated['staff_hero_image'] = $request->file('staff_hero_image')->store('school', 'public');
        } elseif ($request->has('remove_staff_hero_image') && $request->remove_staff_hero_image == '1') {
            if ($profile->staff_hero_image) {
                Storage::disk('public')->delete($profile->staff_hero_image);
            }
            $validated['staff_hero_image'] = null;
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('super_admin.teachers.index')->with('success', 'Hero Guru & Tata Usaha berhasil diperbarui.');
    }
}
