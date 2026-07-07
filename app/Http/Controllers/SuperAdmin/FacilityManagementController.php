<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityManagementController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('order')->get();
        return view('super_admin.sarana.index', compact('facilities'));
    }

    public function create()
    {
        return view('super_admin.sarana.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('facilities', 'public');
        }

        Facility::create($data);

        return redirect()->route('super_admin.sarana.index')->with('success', 'Sarana & Prasarana berhasil ditambahkan.');
    }

    public function edit(Facility $sarana)
    {
        return view('super_admin.sarana.edit', compact('sarana'));
    }

    public function update(Request $request, Facility $sarana)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('facilities', 'public');
        }

        $sarana->update($data);

        return redirect()->route('super_admin.sarana.index')->with('success', 'Sarana & Prasarana berhasil diperbarui.');
    }

    public function destroy(Facility $sarana)
    {
        $sarana->delete();
        return redirect()->route('super_admin.sarana.index')->with('success', 'Sarana & Prasarana berhasil dihapus.');
    }
}
