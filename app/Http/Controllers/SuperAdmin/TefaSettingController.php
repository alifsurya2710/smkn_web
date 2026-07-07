<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TefaSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'tefa')->get()->pluck('value', 'key');
        return view('super-admin.tefa-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'tefa_title' => 'nullable|string',
            'tefa_description' => 'nullable|string',
            'tefa_hero_image' => 'nullable|image|max:5120',
            'tefa_hero_title' => 'nullable|string',
            'tefa_hero_subtitle' => 'nullable|string',
            'tefa_head_name' => 'nullable|string',
            'tefa_head_photo' => 'nullable|image|max:2048',
            'tefa_message_1' => 'nullable|string',
            'tefa_message_2' => 'nullable|string',
            'tefa_message_3' => 'nullable|string',
            'tefa_benefit_1_title' => 'nullable|string',
            'tefa_benefit_1_description' => 'nullable|string',
            'tefa_benefit_2_title' => 'nullable|string',
            'tefa_benefit_2_description' => 'nullable|string',
            'tefa_benefit_3_title' => 'nullable|string',
            'tefa_benefit_3_description' => 'nullable|string',
            'tefa_benefit_4_title' => 'nullable|string',
            'tefa_benefit_4_description' => 'nullable|string',
            'tefa_benefit_5_title' => 'nullable|string',
            'tefa_benefit_5_description' => 'nullable|string',
            'tefa_benefit_6_title' => 'nullable|string',
            'tefa_benefit_6_description' => 'nullable|string',
            'tefa_step_1_title' => 'nullable|string',
            'tefa_step_1_description' => 'nullable|string',
            'tefa_step_2_title' => 'nullable|string',
            'tefa_step_2_description' => 'nullable|string',
            'tefa_step_3_title' => 'nullable|string',
            'tefa_step_3_description' => 'nullable|string',
            'tefa_step_4_title' => 'nullable|string',
            'tefa_step_4_description' => 'nullable|string',
            'tefa_step_5_title' => 'nullable|string',
            'tefa_step_5_description' => 'nullable|string',
            'tefa_step_6_title' => 'nullable|string',
            'tefa_step_6_description' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $oldPath = Setting::getByKey($key);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($key)->store('tefa', 'public');
                Setting::set($key, $path, 'image', 'tefa');
            } else {
                if (!Str::contains($key, 'photo')) {
                    Setting::set($key, $value, 'text', 'tefa');
                }
            }
        }

        return redirect()->back()->with('success', 'Teaching Factory settings updated successfully.');
    }
}
