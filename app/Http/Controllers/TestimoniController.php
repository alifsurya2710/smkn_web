<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'pesan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal. Pastikan semua field terisi dengan benar.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Testimoni::create([
                'nama' => $request->nama,
                'pesan' => $request->pesan,
                'rating' => $request->rating,
                'status' => 'pending', // Always pending initially
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih atas testimoni Anda! Pesan Anda akan muncul setelah disetujui oleh admin.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Testimoni Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf, terjadi kesalahan saat menyimpan testimoni. Silakan coba lagi nanti.'
            ], 500);
        }
    }

    /**
     * Admin dashboard for testimonials.
     */
    public function adminIndex()
    {
        $testimonis = Testimoni::latest()->paginate(10);
        return view('super_admin.testimonis.index', compact('testimonis'));
    }

    /**
     * Approve a testimonial.
     */
    public function approve(Testimoni $testimoni)
    {
        $testimoni->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Testimoni berhasil disetujui.');
    }

    /**
     * Reject or delete a testimonial.
     */
    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
