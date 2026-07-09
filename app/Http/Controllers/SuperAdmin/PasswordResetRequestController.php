<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetRequestController extends Controller
{
    /**
     * Daftar semua permintaan reset password.
     */
    public function index()
    {
        $requests = PasswordResetRequest::with(['user', 'resolver'])
            ->latest()
            ->paginate(15);

        $pendingCount = PasswordResetRequest::pending()->count();

        return view('super-admin.password-reset-requests', compact('requests', 'pendingCount'));
    }

    /**
     * Reset password user dan tandai request sebagai resolved.
     */
    public function resolve(Request $request, PasswordResetRequest $resetRequest)
    {
        $request->validate([
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ]);

        // Update password user
        $resetRequest->user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Tandai request sebagai resolved
        $resetRequest->update([
            'status'      => 'resolved',
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        $route = auth()->user()->hasRole(['super_admin', 'super-admin'])
            ? 'super_admin.password_reset_requests.index'
            : 'admin.password_reset_requests.index';

        return redirect()->route($route)
            ->with('success', 'Password untuk ' . $resetRequest->user->name . ' berhasil direset.');
    }

    /**
     * Tolak / hapus permintaan reset password.
     */
    public function destroy(PasswordResetRequest $resetRequest)
    {
        $resetRequest->delete();

        $route = auth()->user()->hasRole(['super_admin', 'super-admin'])
            ? 'super_admin.password_reset_requests.index'
            : 'admin.password_reset_requests.index';

        return redirect()->route($route)
            ->with('success', 'Permintaan berhasil dihapus.');
    }

    /**
     * Jumlah permintaan pending (untuk notifikasi AJAX).
     */
    public function pendingCount()
    {
        return response()->json([
            'count' => PasswordResetRequest::pending()->count(),
        ]);
    }
}
