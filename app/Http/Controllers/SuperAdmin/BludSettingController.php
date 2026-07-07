<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BludSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'blud')->get()->pluck('value', 'key');
        return view('super-admin.blud-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'blud_title' => 'nullable|string',
            'blud_description' => 'nullable|string',
            'blud_head_name' => 'nullable|string',
            'blud_head_photo' => 'nullable|image|max:2048',
            'blud_message_1' => 'nullable|string',
            'blud_message_2' => 'nullable|string',
            'blud_message_3' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                // Delete old file if exists
                $oldPath = Setting::getByKey($key);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($key)->store('blud', 'public');
                Setting::set($key, $path, 'image', 'blud');
            } else {
                if (!Str::contains($key, 'photo')) {
                    Setting::set($key, $value, 'text', 'blud');
                }
            }
        }

        return redirect()->back()->with('success', 'BLUD settings updated successfully.');
    }
}
