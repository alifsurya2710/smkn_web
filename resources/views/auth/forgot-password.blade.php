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
    </style>

    <div class="flex min-h-screen w-full font-sans bg-white">

        {{-- LEFT SIDE: BRANDING --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            <div class="absolute inset-0 z-0">
                @php $authBg = \App\Models\Setting::getByKey('auth_hero_image', 'images/hero-login.jpg'); @endphp
                <img src="{{ str_starts_with($authBg, 'images/') ? asset($authBg) : asset('storage/' . $authBg) }}"
                     class="h-full w-full object-cover object-center filter brightness-[0.55]"
                     alt="SMKN 1 Katapang">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-indigo-800/30 to-slate-900/70 mix-blend-multiply animate-gradient-bg"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col justify-between p-12 lg:p-16 text-white h-full">
                <div>
                    <span class="text-[13px] font-bold tracking-widest uppercase opacity-90 drop-shadow-sm">SMKN 1 KATAPANG</span>
                </div>

                <div class="max-w-xl pb-32">
                    <div class="mb-6 inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3">
                        <div class="w-8 h-8 rounded-full bg-amber-400/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <span class="text-[11px] font-bold tracking-wider text-white/90 uppercase">Reset Kata Sandi</span>
                    </div>
                    <h1 class="text-[3.5rem] lg:text-[4.5rem] font-black leading-[1.05] tracking-tight mb-5 drop-shadow-lg">
                        <span class="block text-white">Lupa</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 animate-gradient-bg">Kata Sandi?</span>
                    </h1>
                    <p class="text-[15px] opacity-[0.85] leading-relaxed font-medium max-w-sm text-slate-100">
                        Masukkan email terdaftar Anda. Permintaan akan diteruskan ke administrator untuk diproses.
                    </p>
                </div>

                <div class="text-[11px] font-medium opacity-60 tracking-wide">
                    &copy; 2026 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: FORM --}}
        <div class="w-full lg:w-1/2 bg-white flex flex-col items-center justify-center p-6 sm:p-12 lg:p-20 relative">
            <div class="w-full max-w-[380px] space-y-7">

                {{-- Header --}}
                <div class="text-center space-y-4 flex flex-col items-center fade-in-up">
                    {{-- Logo --}}
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden drop-shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo SMKN 1 Katapang" class="h-full w-auto object-contain">
                    </div>
                    <div>
                        <h2 class="text-[22px] font-bold text-slate-800 tracking-tight">Lupa Kata Sandi?</h2>
                        <p class="text-[12px] text-slate-500 mt-1.5 leading-relaxed max-w-[280px] mx-auto">
                            Masukkan email terdaftar Anda. Permintaan akan diteruskan ke administrator untuk diproses.
                        </p>
                    </div>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 fade-in-up fade-in-up-d1">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-semibold text-emerald-700">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4 fade-in-up fade-in-up-d2">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="text-[10px] font-bold text-slate-600 tracking-wide">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                   placeholder="email@example.com"
                                   class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Kirim Permintaan Reset
                        </button>
                    </div>
                </form>

                {{-- Back to login --}}
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
