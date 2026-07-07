<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'landing')->get()->pluck('value', 'key');
        return view('super_admin.landing_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'landing_hero_title' => 'nullable|string',
            'landing_hero_description' => 'nullable|string',
            'landing_hero_video' => 'nullable|file|mimes:mp4,webm,gif|max:20480',
            'landing_hero_image_1' => 'nullable|image|max:5120',
            'landing_hero_image_2' => 'nullable|image|max:5120',
            'landing_hero_image_3' => 'nullable|image|max:5120',
            'extracurricular_hero_title' => 'nullable|string',
            'extracurricular_hero_description' => 'nullable|string',
            'extracurricular_hero_image' => 'nullable|image|max:5120',
            'major_hero_title' => 'nullable|string',
            'major_hero_description' => 'nullable|string',
            'major_hero_image' => 'nullable|image|max:5120',
            'stats_siswa_count' => 'nullable|string',
            'stats_pengajar_count' => 'nullable|string',
            'stats_mitra_count' => 'nullable|string',
            'stats_alumni_working_count' => 'nullable|string',
        ]);

        if ($request->boolean('delete_hero_video')) {
            $oldPath = Setting::getByKey('landing_hero_video');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            Setting::where('key', 'landing_hero_video')->delete();
        }

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                // Delete old file if exists
                $oldPath = Setting::getByKey($key);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($key)->store('settings', 'public');
                $type = Str::contains($key, 'video') ? 'video' : 'image';
                Setting::set($key, $path, $type, 'landing');
            } else {
                if (!Str::contains($key, 'image') && !Str::contains($key, 'video')) {
                    Setting::set($key, $value, 'text', 'landing');
                }
            }
        }

        return redirect()->back()->with('success', 'Landing page settings updated successfully.');
    }
}
