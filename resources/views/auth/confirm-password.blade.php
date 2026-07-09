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
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.5s ease both; }
        .fade-in-up-d1 { animation-delay: 0.05s; }
        .fade-in-up-d2 { animation-delay: 0.12s; }
        .fade-in-up-d3 { animation-delay: 0.19s; }
        @keyframes pulseRing {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.08); opacity: 0.7; }
        }
        .shield-pulse { animation: pulseRing 2.5s ease-in-out infinite; }
    </style>

    <div class="flex min-h-screen w-full font-sans bg-white">

        {{-- LEFT SIDE: BRANDING --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero-login.jpg') }}"
                     class="h-full w-full object-cover object-center filter brightness-[0.55]"
                     alt="SMKN 1 Katapang">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/60 via-teal-800/30 to-slate-900/70 mix-blend-multiply animate-gradient-bg"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col justify-between p-12 lg:p-16 text-white h-full">
                <div>
                    <span class="text-[13px] font-bold tracking-widest uppercase opacity-90 drop-shadow-sm">SMKN 1 KATAPANG</span>
                </div>

                <div class="max-w-xl pb-32">
                    <div class="mb-6 inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-400/20 flex items-center justify-center shield-pulse">
                            <svg class="w-4 h-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="text-[11px] font-bold tracking-wider text-white/90 uppercase">Area Aman</span>
                    </div>
                    <h1 class="text-[3.5rem] lg:text-[4.5rem] font-black leading-[1.05] tracking-tight mb-5 drop-shadow-lg">
                        <span class="block text-white">Konfirmasi</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 animate-gradient-bg">Identitas Anda</span>
                    </h1>
                    <p class="text-[15px] opacity-[0.85] leading-relaxed font-medium max-w-sm text-slate-100">
                        Area ini memerlukan verifikasi kata sandi sebelum Anda dapat melanjutkan ke halaman yang aman.
                    </p>
                </div>

                <div class="text-[11px] font-medium opacity-60 tracking-wide">
                    &copy; 2024 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: FORM --}}
        <div class="w-full lg:w-1/2 bg-white flex flex-col items-center justify-center p-6 sm:p-12 lg:p-20 relative">
            <div class="w-full max-w-[380px] space-y-7">

                {{-- Header --}}
                <div class="text-center space-y-4 flex flex-col items-center fade-in-up">
                    <div class="mb-2 w-16 h-16 flex items-center justify-center overflow-hidden drop-shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Logo_SMK_Negeri_1_Katapang.png/600px-Logo_SMK_Negeri_1_Katapang.png"
                             onerror="this.src='https://via.placeholder.com/80/e2e8f0/0f172a?text=SMK';"
                             alt="Logo" class="h-full w-auto object-contain">
                    </div>
                    <div>
                        <h2 class="text-[22px] font-bold text-slate-800 tracking-tight">Konfirmasi Kata Sandi</h2>
                        <p class="text-[12px] text-slate-500 mt-1.5 leading-relaxed max-w-[280px] mx-auto">
                            Ini adalah area aman. Mohon konfirmasi kata sandi Anda sebelum melanjutkan.
                        </p>
                    </div>
                </div>

                {{-- Security badge --}}
                <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 fade-in-up fade-in-up-d1">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <p class="text-[11px] font-semibold text-emerald-700">Sesi Anda terenkripsi dan aman</p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4 fade-in-up fade-in-up-d2">
                    @csrf

                    {{-- Password --}}
                    <div class="space-y-1.5" x-data="{ show: false }">
                        <label for="password" class="text-[10px] font-bold text-slate-600 tracking-wide">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                   placeholder="Masukkan kata sandi Anda"
                                   class="block w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer transition-colors" @click="show = !show">
                                <svg x-show="!show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-cloak x-show="show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Konfirmasi dan Lanjutkan
                        </button>
                    </div>
                </form>

                {{-- Footer --}}
                <div class="pt-2 text-center fade-in-up fade-in-up-d3">
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest font-black">
                            <a href="{{ route('login') }}" class="bg-white px-4 text-blue-600 hover:text-blue-800 transition-colors">
                                Kembali ke Halaman Masuk
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="w-full py-2.5 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[11px] font-semibold text-slate-600 hover:text-slate-800 hover:border-slate-300 hover:bg-slate-50 hover:shadow-sm transition-all group">
                            <svg class="h-[14px] w-[14px] text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            Halaman Utama
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
