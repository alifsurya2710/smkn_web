<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrestasiCategory;
use Illuminate\Support\Str;

class PrestasiCategoryController extends Controller
{
    public function index()
    {
        $categories = PrestasiCategory::latest()->paginate(10);
        return view('super-admin.prestasi-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('super-admin.prestasi-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:prestasi_categories',
        ]);

        PrestasiCategory::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()->route('super_admin.prestasi_categories.index')->with('success', 'Kategori Berhasil Ditambah!');
    }

    public function destroy(PrestasiCategory $prestasiCategory)
    {
        $prestasiCategory->delete();
        return back()->with('success', 'Kategori Berhasil Dihapus!');
    }
}
