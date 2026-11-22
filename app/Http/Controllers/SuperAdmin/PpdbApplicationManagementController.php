<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Mail\PpdbStatusUpdatedMail;
use App\Exports\PpdbApplicationsExport;
use App\Imports\PpdbApplicationsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PpdbApplicationManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = PpdbApplication::with('user')->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('jalur') && $request->jalur !== 'all') {
            $query->where('jalur_pendaftaran', $request->jalur);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(12)->withQueryString();

        $stats = [
            'total'    => PpdbApplication::count(),
            'pending'  => PpdbApplication::where('status', 'pending')->count(),
            'approved' => PpdbApplication::where('status', 'approved')->count(),
            'rejected' => PpdbApplication::where('status', 'rejected')->count(),
        ];

        return view('super-admin.ppdb.index', compact('applications', 'stats'));
    }

    public function show($id)
    {
        $application = PpdbApplication::with('user')->findOrFail($id);
        return view('super-admin.ppdb.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = PpdbApplication::findOrFail($id);

        $request->validate([
            'status'  => 'required|in:approved,rejected,pending',
            'catatan' => 'nullable|string|max:1000',
        ]);

        if ($request->status === 'rejected' && empty(trim($request->catatan))) {
            return back()->withErrors(['catatan' => 'Wajib memberikan penjelasan / alasan kenapa pendaftaran ditolak (reject).'])->withInput();
        }

        $application->status = $request->status;
        $application->catatan = $request->catatan;
        $application->save();

        // Kirim notifikasi email ke Gmail pendaftar
        $recipientEmail = $application->email ?? $application->user->email ?? null;

        if ($recipientEmail && in_array($application->status, ['approved', 'rejected'])) {
            try {
                Mail::to($recipientEmail)->send(new PpdbStatusUpdatedMail($application));
            } catch (\Exception $e) {
                Log::error("Gagal mengirim email status SPMB ke {$recipientEmail}: " . $e->getMessage());
                return redirect()->route('super_admin.ppdb_applications.show', $application->id)
                    ->with('success', "Status pendaftaran berhasil diubah menjadi {$statusLabel}. (Email notifikasi dilewati karena SMTP belum dikonfigurasi).");
            }
        }

        $statusLabel = $application->status === 'approved' ? 'DITERIMA (APPROVED)' : 'DITOLAK (REJECTED)';

        return redirect()->route('super_admin.ppdb_applications.show', $application->id)
            ->with('success', "Status pendaftaran berhasil diubah menjadi {$statusLabel} dan notifikasi email telah dikirim ke {$recipientEmail}!");
    }

    /**
     * Download / Export data pendaftaran SPMB ke format Excel
     */
    public function export(Request $request)
    {
        $status = $request->status;
        $search = $request->search;
        $jalur  = $request->jalur;
        $timestamp = date('Y-m-d_His');
        $fileName = "Data_Pendaftar_SPMB_RA_AL-IKHWAN_{$timestamp}.xlsx";

        return Excel::download(new PpdbApplicationsExport($status, $search, $jalur), $fileName);
    }

    /**
     * Import data pendaftaran SPMB dari file Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ], [
            'excel_file.required' => 'File Excel wajib dipilih.',
            'excel_file.mimes'    => 'Format file harus berupa .xlsx, .xls, atau .csv.',
            'excel_file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        try {
            Excel::import(new PpdbApplicationsImport, $request->file('excel_file'));
            return back()->with('success', 'Data pendaftaran SPMB dari Excel berhasil diimpor ke sistem!');
        } catch (\Exception $e) {
            Log::error('Gagal import Excel SPMB: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengimpor file Excel: ' . $e->getMessage());
        }
    }
}
