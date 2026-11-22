<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SpmbAuthController extends Controller
{
    /**
     * Get a fresh math captcha for SPMB (AJAX)
     */
    public function captcha(Request $request)
    {
        $type = $request->query('type', 'spmb_login');
        $validTypes = ['spmb_login', 'spmb_register'];
        if (!in_array($type, $validTypes)) {
            $type = 'spmb_login';
        }

        $captcha = \App\Services\MathCaptchaService::generate($type);

        return response()->json([
            'question' => "{$captcha['num1']} {$captcha['op']} {$captcha['num2']} = ?",
            'num1'     => $captcha['num1'],
            'op'       => $captcha['op'],
            'num2'     => $captcha['num2'],
        ]);
    }

    /**
     * Handle SPMB Login (AJAX)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'        => ['required', 'string', 'email'],
            'password'     => ['required', 'string'],
            'math_captcha' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if (!\App\Services\MathCaptchaService::validate('spmb_login', $value)) {
                    $fail('Jawaban hitung cepat captcha salah. Silakan coba lagi.');
                }
            }],
        ], [
            'email.required'        => 'Alamat email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'math_captcha.required' => 'Harap isi jawaban perhitungan matematika.',
            'math_captcha.numeric'  => 'Jawaban captcha harus berupa angka.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Memuat formulir...',
                'user'    => Auth::user(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau kata sandi yang Anda masukkan salah.',
        ], 422);
    }

    /**
     * Handle SPMB Register (AJAX)
     */
    public function register(Request $request)
    {
        $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'no_telp'      => ['required', 'string', 'max:20'],
            'password'     => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'math_captcha' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if (!\App\Services\MathCaptchaService::validate('spmb_register', $value)) {
                    $fail('Jawaban hitung cepat captcha salah. Silakan coba lagi.');
                }
            }],
        ], [
            'student_name.required' => 'Nama calon murid / siswa wajib diisi.',
            'name.required'         => 'Nama lengkap orang tua / wali wajib diisi.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.unique'          => 'Alamat email ini sudah terdaftar.',
            'no_telp.required'      => 'Nomor telepon / WhatsApp wajib diisi.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'          => 'Kata sandi minimal 8 karakter.',
            'password.regex'        => 'Kata sandi harus mengandung huruf besar (A-Z), huruf kecil (a-z), angka (0-9), dan simbol (@$!%*?&).',
            'math_captcha.required' => 'Harap isi jawaban perhitungan matematika.',
            'math_captcha.numeric'  => 'Jawaban captcha harus berupa angka.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_telp'  => $request->no_telp,
            'password' => Hash::make($request->password),
        ]);

        // Simpan nama calon murid ke session agar otomatis terisi di formulir SPMB setelah register
        session(['spmb_student_name' => $request->student_name]);

        // Berikan role pendaftar jika ada, atau buat jika belum ada
        try {
            Role::firstOrCreate(['name' => 'pendaftar']);
            $user->assignRole('pendaftar');
        } catch (\Exception $e) {
            // Ignore if role system is bypassed
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Akun pendaftar berhasil dibuat! Memuat formulir...',
            'user'    => $user,
        ]);
    }
}
