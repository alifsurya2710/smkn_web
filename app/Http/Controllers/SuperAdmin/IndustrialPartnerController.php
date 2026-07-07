<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\IndustrialPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustrialPartnerController extends Controller
{
    public function index()
    {
        $partners = IndustrialPartner::orderBy('order')->get();
        return view('super_admin.industrial_partners.index', compact('partners'));
    }

    public function create()
    {
        return view('super_admin.industrial_partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        IndustrialPartner::create($data);

        return redirect()->route('super_admin.industrial_partners.index')->with('success', 'Mitra Industri berhasil ditambahkan.');
    }

    public function edit(IndustrialPartner $industrial_partner)
    {
        return view('super_admin.industrial_partners.edit', compact('industrial_partner'));
    }

    public function update(Request $request, IndustrialPartner $industrial_partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($industrial_partner->logo) {
                Storage::disk('public')->delete($industrial_partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $industrial_partner->update($data);

        return redirect()->route('super_admin.industrial_partners.index')->with('success', 'Mitra Industri berhasil diperbarui.');
    }

    public function destroy(IndustrialPartner $industrial_partner)
    {
        $industrial_partner->delete();
        return redirect()->route('super_admin.industrial_partners.index')->with('success', 'Mitra Industri berhasil dihapus.');
    }
}
