<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthAppearanceController extends Controller
{
    public function index()
    {
        $authHeroImage = Setting::getByKey('auth_hero_image', 'images/hero-login.jpg');
        return view('super-admin.auth-appearance', compact('authHeroImage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'auth_hero_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Hapus gambar lama dari storage jika bukan gambar default
        $oldPath = Setting::getByKey('auth_hero_image');
        if ($oldPath && !str_starts_with($oldPath, 'images/') && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $path = $request->file('auth_hero_image')->store('settings/auth', 'public');

        Setting::set('auth_hero_image', $path, 'image', 'auth');

        $route = auth()->user()->hasRole(['super_admin', 'super-admin'])
            ? 'super_admin.auth_appearance.index'
            : 'admin.auth_appearance.index';

        return redirect()->route($route)->with('success', 'Gambar background halaman autentikasi berhasil diperbarui.');
    }

    public function reset()
    {
        // Hapus gambar lama dari storage jika bukan default
        $oldPath = Setting::getByKey('auth_hero_image');
        if ($oldPath && !str_starts_with($oldPath, 'images/') && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        Setting::set('auth_hero_image', 'images/hero-login.jpg', 'image', 'auth');

        $route = auth()->user()->hasRole(['super_admin', 'super-admin'])
            ? 'super_admin.auth_appearance.index'
            : 'admin.auth_appearance.index';

        return redirect()->route($route)->with('success', 'Background berhasil direset ke gambar default.');
    }
}
