<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        $profile = SchoolProfile::first() ?? new SchoolProfile();
        return view('super-admin.school-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SchoolProfile::first() ?? new SchoolProfile();

        $validated = $request->validate([
            'about_hero_title' => 'nullable|string|max:255',
            'about_hero_description' => 'nullable|string',
            'about_hero_image' => 'nullable|image|max:2048',
            'vision' => 'nullable|string',
            'mission' => 'nullable|array',
            'principal_name' => 'nullable|string|max:255',
            'principal_title' => 'nullable|string|max:255',
            'principal_message' => 'nullable|string',
            'principal_photo' => 'nullable|image|max:2048',
            'history' => 'nullable|array',
            'stats' => 'nullable|array',
        ]);

        if ($request->hasFile('about_hero_image')) {
            if ($profile->about_hero_image) {
                Storage::disk('public')->delete($profile->about_hero_image);
            }
            $validated['about_hero_image'] = $request->file('about_hero_image')->store('profile', 'public');
        }

        if ($request->hasFile('principal_photo')) {
            if ($profile->principal_photo) {
                Storage::disk('public')->delete($profile->principal_photo);
            }
            $validated['principal_photo'] = $request->file('principal_photo')->store('profile', 'public');
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
