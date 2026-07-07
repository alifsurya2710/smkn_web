<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpdbSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'ppdb')->get()->pluck('value', 'key');
        return view('super-admin.ppdb-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'ppdb_hero_image' => 'nullable|image|max:5120',
            'ppdb_jadwal_image' => 'nullable|image|max:5120',
            'ppdb_alur_image' => 'nullable|image|max:5120',
            'ppdb_kuota_image' => 'nullable|image|max:5120',
        ]);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $oldPath = Setting::getByKey($key);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($key)->store('ppdb', 'public');
                Setting::set($key, $path, 'image', 'ppdb');
            }
        }

        return redirect()->back()->with('success', 'Foto halaman PPDB berhasil diperbarui.');
    }
}
