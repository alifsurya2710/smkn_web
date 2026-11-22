<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $captcha = \App\Services\MathCaptchaService::generate('register');
        return view('auth.register', compact('captcha'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'nisn'     => ['nullable', 'string', 'max:20', 'unique:users,nisn'],
            'no_telp'  => ['nullable', 'string', 'max:15'],
            'math_captcha' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if (!\App\Services\MathCaptchaService::validate('register', $value)) {
                    $fail('Jawaban perhitungan matematika captcha salah. Silakan coba lagi.');
                }
            }],
        ], [
            'math_captcha.required' => 'Harap isi jawaban perhitungan matematika.',
            'math_captcha.numeric'  => 'Jawaban captcha harus berupa angka.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nisn' => $request->nisn,
            'no_telp' => $request->no_telp,
        ]);

        $user->assignRole('guru');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
