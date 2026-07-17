<x-guest-layout>
    <style>
        @keyframes gradient-bg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-bg {
            background-size: 200% 200%;
            animation: gradient-bg 8s ease infinite;
        }
    </style>
    @if(env('RECAPTCHA_SITE_KEY'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    <div class="flex min-h-screen w-full font-sans bg-white">
        <!-- LEFT SIDE: BRANDING -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            <!-- Background Image with Animated Gradient Overlay -->
            <div class="absolute inset-0 z-0">
                @php $authBg = \App\Models\Setting::getByKey('auth_hero_image', 'images/hero-login.jpg'); @endphp
                <img src="{{ str_starts_with($authBg, 'images/') ? asset($authBg) : asset('storage/' . $authBg) }}" 
                     class="h-full w-full object-cover object-center filter brightness-[0.55]" 
                     style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;"
                     alt="SMKN 1 Katapang Building">
                <!-- Animated Gradient Overlay -->
                <!-- Use a slightly lighter blue/purple gradient so the HD background remains clear -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-indigo-800/30 to-slate-900/70 mix-blend-multiply animate-gradient-bg"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full flex flex-col justify-between p-12 lg:p-16 text-white h-full">
                <!-- Top Brand text -->
                <div>
                    <span class="text-[13px] font-bold tracking-widest uppercase opacity-90 drop-shadow-sm font-sans">SMKN 1 KATAPANG</span>
                </div>

                <!-- Main Text Content -->
                <div class="max-w-xl pb-32">
                    <h1 class="text-[4rem] lg:text-[5rem] font-black leading-[1.05] tracking-tight mb-5 translate-y-8 drop-shadow-lg">
                        <span class="block text-white">SMKN 1</span>
                        <!-- Animated Gradient Text -->
                        <span class="block text-blue-600 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 animate-gradient-bg">KATAPANG</span>
                    </h1>
                    <p class="text-[15px] opacity-[0.85] leading-relaxed font-medium mt-6 max-w-sm text-slate-100 translate-y-8 font-sans">
                        "Belajar pintar, pantau progres, raih<br>
                        nilai terbaik - portal digital untuk siswa<br>
                        SMKN siap kerja"
                    </p>
                </div>

                <!-- Footer text -->
                <div class="text-[11px] font-medium opacity-60 font-sans tracking-wide">
                    &copy; 2026 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: FORM -->
        <div class="w-full lg:w-1/2 bg-white flex flex-col items-center justify-center p-6 sm:p-12 lg:p-20 relative">
            <div class="w-full max-w-[380px] space-y-7">
                <!-- Header -->
                <div class="text-center space-y-6 flex flex-col items-center">
                    <!-- Logo -->
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden drop-shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo SMKN 1 Katapang" class="h-full w-auto object-contain">
                    </div>
                    <h2 class="text-[22px] font-bold text-slate-800 tracking-tight font-sans">Selamat Datang Kembali</h2>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4 pt-2">
                    @csrf

                    <!-- NISN / Username -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-[10px] font-bold text-slate-600 tracking-wide">NISN / Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <!-- Assuming email/username field is mapped to "email" correctly in controller -->
                            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus 
                                   placeholder="Masukkan NISN atau Nama Pengguna"
                                   class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5 pt-1">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-[10px] font-bold text-slate-600 tracking-wide">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-blue-600 hover:text-blue-800 tracking-wide transition-colors">Lupa Kata Sandi?</a>
                            @endif
                        </div>
                        <div class="relative group" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                   placeholder="Masukkan kata sandi Anda"
                                   class="block w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer transition-colors" @click="show = !show">
                                <svg x-show="!show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-cloak x-show="show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center pt-2 pb-3">
                        <input id="remember_me" type="checkbox" name="remember" class="w-[12px] h-[12px] text-black border-slate-300 rounded focus:ring-black focus:ring-offset-0 transition-colors">
                        <label for="remember_me" class="ml-2 text-[10px] font-semibold text-slate-500 tracking-wide">Ingat perangkat ini selama 30 hari</label>
                    </div>

                    {{-- reCAPTCHA --}}
                    @if(env('RECAPTCHA_SITE_KEY'))
                    <div class="flex justify-center">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    </div>
                    @if($errors->has('g-recaptcha-response'))
                        <p class="text-xs text-red-500 text-center">{{ $errors->first('g-recaptcha-response') }}</p>
                    @endif
                    @endif

                    <!-- Submit -->
                    <button type="submit" class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md">
                        Masuk
                    </button>
                    
                </form>

                <!-- Footer Support -->
                <div class="pt-8 text-center">
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest font-black">
                             <a href="{{ route('register') }}" class="bg-white px-4 text-blue-600 hover:text-blue-800 transition-colors">Belum punya akun? Daftar Baru</a>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="w-full py-2.5 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[11px] font-semibold text-slate-600 hover:text-slate-800 hover:border-slate-300 hover:bg-slate-50 hover:shadow-sm transition-all group">
                            <svg class="h-[14px] w-[14px] text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
