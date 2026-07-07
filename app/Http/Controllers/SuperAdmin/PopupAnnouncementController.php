<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PopupAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = PopupAnnouncement::latest()->get();
        return view('super_admin.popup_announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('super_admin.popup_announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:5120',
            'link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('popups', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        PopupAnnouncement::create($data);

        return redirect()->route('super_admin.popup_announcements.index')->with('success', 'Popup announcement created successfully.');
    }

    public function edit(PopupAnnouncement $popupAnnouncement)
    {
        return view('super_admin.popup_announcements.edit', compact('popupAnnouncement'));
    }

    public function update(Request $request, PopupAnnouncement $popupAnnouncement)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($popupAnnouncement->image && Storage::disk('public')->exists($popupAnnouncement->image)) {
                Storage::disk('public')->delete($popupAnnouncement->image);
            }
            $data['image'] = $request->file('image')->store('popups', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $popupAnnouncement->update($data);

        return redirect()->route('super_admin.popup_announcements.index')->with('success', 'Popup announcement updated successfully.');
    }

    public function destroy(PopupAnnouncement $popupAnnouncement)
    {
        if ($popupAnnouncement->image && Storage::disk('public')->exists($popupAnnouncement->image)) {
            Storage::disk('public')->delete($popupAnnouncement->image);
        }
        $popupAnnouncement->delete();

        return redirect()->route('super_admin.popup_announcements.index')->with('success', 'Popup announcement deleted successfully.');
    }
}
