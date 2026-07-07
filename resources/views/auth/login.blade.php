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
    <div class="flex min-h-screen w-full font-sans bg-white">
        <!-- LEFT SIDE: BRANDING -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            <!-- Background Image with Animated Gradient Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero-login.jpg') }}" 
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
                    &copy; 2024 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: FORM -->
        <div class="w-full lg:w-1/2 bg-white flex flex-col items-center justify-center p-6 sm:p-12 lg:p-20 relative">
            <div class="w-full max-w-[380px] space-y-7">
                <!-- Header -->
                <div class="text-center space-y-6 flex flex-col items-center">
                    <!-- School Logo -->
                    <div class="mb-2 w-16 h-16 flex items-center justify-center overflow-hidden drop-shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Logo_SMK_Negeri_1_Katapang.png/600px-Logo_SMK_Negeri_1_Katapang.png" 
                             onerror="this.src='https://via.placeholder.com/80/e2e8f0/0f172a?text=SMK';"
                             alt="Logo" class="h-full w-auto object-contain">
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

                    <!-- Submit -->
                    <button type="submit" class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md">
                        Masuk
                    </button>
                    
                    <!-- Social Login Section -->
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest font-black">
                            <span class="bg-white px-4 text-slate-300">Atau Masuk Dengan</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-2.5">
                        <!-- Google -->
                         <a href="{{ route('social.redirect', 'google') }}" class="w-full py-2 px-4 border border-slate-200 rounded-lg flex items-center justify-center gap-3 text-[11px] font-bold text-slate-700 hover:bg-slate-50 transition-all">
                            <svg class="h-4 w-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                            Masuk dengan Google
                        </a>

                        <div class="grid grid-cols-2 gap-2.5">
                             <!-- Facebook -->
                             <a href="{{ route('social.redirect', 'facebook') }}" class="py-2 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50 transition-all">
                                <svg class="h-4 w-4 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <!-- Twitter -->
                             <a href="{{ route('social.redirect', 'twitter') }}" class="py-2 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[10px] font-bold text-slate-700 hover:bg-slate-50 transition-all">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932 6.064-6.932zm-1.291 19.497h2.039L6.486 3.24H4.298L17.61 20.65z"/></svg>
                                Twitter / X
                            </a>
                        </div>
                    </div>
                    
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
                    
                    <div class="flex gap-3 mt-4">
                         <a href="#" class="flex-1 py-2 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[10px] font-semibold text-slate-600 hover:text-slate-800 hover:border-slate-300 hover:bg-slate-50 hover:shadow-sm transition-all group">
                            <svg class="h-[14px] w-[14px] text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Pusat Bantuan
                        </a>
                        <a href="{{ url('/') }}" class="flex-1 py-2 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[10px] font-semibold text-slate-600 hover:text-slate-800 hover:border-slate-300 hover:bg-slate-50 hover:shadow-sm transition-all group">
                            <svg class="h-[14px] w-[14px] text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
