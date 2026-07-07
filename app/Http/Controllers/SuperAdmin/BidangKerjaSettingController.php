<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BidangKerjaSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'bidang_kerja')->get()->pluck('value', 'key');
        return view('super-admin.bidang-kerja-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $areas = [
            'kurikulum',
            'kesiswaan',
            'sarana_prasarana',
            'hubungan_industri',
        ];

        $rules = [];
        foreach ($areas as $area) {
            $rules[$area . '_text'] = 'nullable|string';
            $rules[$area . '_image'] = 'nullable|image|max:5120';
        }

        $data = $request->validate($rules);

        foreach ($areas as $area) {
            // Update Text
            if (isset($data[$area . '_text'])) {
                Setting::set($area . '_text', $data[$area . '_text'], 'text', 'bidang_kerja');
            }

            // Update Image
            if ($request->hasFile($area . '_image')) {
                $oldPath = Setting::getByKey($area . '_image');
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($area . '_image')->store('bidang-kerja', 'public');
                Setting::set($area . '_image', $path, 'image', 'bidang_kerja');
            }
        }

        return redirect()->back()->with('success', 'Informasi Bidang Kerja berhasil diperbarui.');
    }
}
