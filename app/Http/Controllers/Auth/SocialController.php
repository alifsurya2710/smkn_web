<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    /**
     * Redirect to the provider's authentication page.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle provider callback.
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Find or create user
            $user = User::where('social_id', $socialUser->getId())
                        ->where('social_type', $provider)
                        ->first();

            // Also check by email to avoid duplicates
            if (!$user) {
                $userByEmail = User::where('email', $socialUser->getEmail())->first();
                if ($userByEmail) {
                    $user = $userByEmail;
                    // Update social fields
                    $user->update([
                        'social_id' => $socialUser->getId(),
                        'social_type' => $provider,
                        'social_token' => $socialUser->token,
                        'social_refresh_token' => $socialUser->refreshToken,
                    ]);
                }
            }

            if (!$user) {
                // Register new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? explode('@', $socialUser->getEmail())[0],
                    'email' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                    'social_token' => $socialUser->token,
                    'social_refresh_token' => $socialUser->refreshToken,
                    'password' => null, // Making it nullable in migration, or set a dummy password
                ]);

                // Assign default role 'user'
                if ($user->exists) {
                    $user->assignRole('user');
                }
            } else {
                // Just update tokens
                $user->update([
                    'social_token' => $socialUser->token,
                    'social_refresh_token' => $socialUser->refreshToken,
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Berhasil masuk menggunakan ' . ucfirst($provider));

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal masuk menggunakan ' . ucfirst($provider) . '. Terjadi kesalahan.');
        }
    }
}
