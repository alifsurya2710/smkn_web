<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\PpdbApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'ppdb')->get()->pluck('value', 'key');
        
        $userApplication = null;
        if (Auth::check()) {
            $userApplication = PpdbApplication::where('user_id', Auth::id())->latest()->first();
        }

        return view('school.ppdb', compact('settings', 'userApplication'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengisi formulir pendaftaran.');
        }

        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'parent_name'      => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'nisn'             => 'nullable|string|max:30',
            'jalur_pendaftaran'=> 'nullable|string|in:reguler,yatim,prestasi,kurang_mampu',
            'nominal_biaya'    => 'nullable|numeric',
            'pernah_paud'      => 'required|in:0,1',
            'foto_kk'          => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'foto_akta'        => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'foto_rapot_paud'  => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'bukti_transfer'   => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
        ], [
            'full_name.required'       => 'Nama murid wajib diisi.',
            'parent_name.required'     => 'Nama orang tua / wali wajib diisi.',
            'phone.required'           => 'Nomor HP / WhatsApp aktif wajib diisi.',
            'pernah_paud.required'     => 'Pilih status apakah pernah PAUD atau tidak.',
            'foto_kk.required'         => 'Foto Kartu Keluarga (KK) wajib diunggah.',
            'foto_akta.required'       => 'Foto Akta Kelahiran wajib diunggah.',
            'bukti_transfer.required'  => 'Bukti transaksi pembayaran wajib diunggah.',
        ]);

        if ($request->pernah_paud == '1' && !$request->hasFile('foto_rapot_paud')) {
            return back()->withErrors(['foto_rapot_paud' => 'Bagi calon murid yang pernah PAUD, foto rapot / surat keterangan PAUD wajib diunggah.'])->withInput();
        }

        // Tentukan nominal biaya berdasarkan jalur
        $jalur = $request->input('jalur_pendaftaran', 'reguler');
        $nominal = match ($jalur) {
            'yatim'        => 0,
            'kurang_mampu' => 50000,
            'prestasi'     => 100000,
            default        => 150000,
        };

        // Simpan Berkas
        $kkPath = $request->file('foto_kk')->store('ppdb/kk', 'public');
        $aktaPath = $request->file('foto_akta')->store('ppdb/akta', 'public');
        $rapotPath = $request->hasFile('foto_rapot_paud') ? $request->file('foto_rapot_paud')->store('ppdb/rapot', 'public') : null;
        $buktiPath = $request->file('bukti_transfer')->store('ppdb/transfer', 'public');

        $regNumber = 'SPMB-RA-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        PpdbApplication::create([
            'registration_number' => $regNumber,
            'user_id'             => Auth::id(),
            'full_name'           => $request->full_name,
            'parent_name'         => $request->parent_name,
            'email'               => Auth::user()->email,
            'phone'               => $request->phone,
            'nisn'                => $request->nisn,
            'jalur_pendaftaran'   => $jalur,
            'nominal_biaya'       => $nominal,
            'pernah_paud'         => (bool)$request->pernah_paud,
            'foto_kk'             => $kkPath,
            'foto_akta'           => $aktaPath,
            'foto_rapot_paud'     => $rapotPath,
            'bukti_transfer'      => $buktiPath,
            'status'              => 'pending',
        ]);

        return redirect()->route('ppdb.index')->with('success_spmb', "Pendaftaran SPMB berhasil dikirim! Nomor pendaftaran Anda adalah {$regNumber}. Petugas kami akan memverifikasi berkas Anda.");
    }
}
