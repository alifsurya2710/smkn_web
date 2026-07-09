<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset request.
     * Menyimpan permintaan ke database agar dapat diproses oleh Super Admin / Admin.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // Cek apakah sudah ada permintaan pending untuk user ini
        $existing = PasswordResetRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (! $existing) {
            PasswordResetRequest::create([
                'user_id' => $user->id,
                'status'  => 'pending',
            ]);
        }

        return back()->with('status', 'Permintaan reset kata sandi Anda telah dikirim. Silakan hubungi administrator untuk memproses permintaan Anda.');
    }
}
