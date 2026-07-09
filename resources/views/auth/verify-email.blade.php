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
        @keyframes emailBounce {
            0%, 100% { transform: translateY(0); }
            30%       { transform: translateY(-6px); }
            60%       { transform: translateY(-3px); }
        }
        .email-bounce { animation: emailBounce 2.5s ease-in-out infinite; }
    </style>

    <div class="flex min-h-screen w-full font-sans bg-white">

        {{-- LEFT SIDE: BRANDING --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero-login.jpg') }}"
                     class="h-full w-full object-cover object-center filter brightness-[0.55]"
                     alt="SMKN 1 Katapang">
                <div class="absolute inset-0 bg-gradient-to-br from-sky-900/60 via-blue-800/30 to-slate-900/70 mix-blend-multiply animate-gradient-bg"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col justify-between p-12 lg:p-16 text-white h-full">
                <div>
                    <span class="text-[13px] font-bold tracking-widest uppercase opacity-90 drop-shadow-sm">SMKN 1 KATAPANG</span>
                </div>

                <div class="max-w-xl pb-32">
                    <div class="mb-6 inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3">
                        <div class="w-8 h-8 rounded-full bg-sky-400/20 flex items-center justify-center email-bounce">
                            <svg class="w-4 h-4 text-sky-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-[11px] font-bold tracking-wider text-white/90 uppercase">Verifikasi Email</span>
                    </div>
                    <h1 class="text-[3.5rem] lg:text-[4.5rem] font-black leading-[1.05] tracking-tight mb-5 drop-shadow-lg">
                        <span class="block text-white">Cek</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-400 animate-gradient-bg">Kotak Masuk</span>
                        <span class="block text-white text-[2.5rem] lg:text-[3rem]">Email Anda</span>
                    </h1>
                    <p class="text-[15px] opacity-[0.85] leading-relaxed font-medium max-w-sm text-slate-100">
                        Kami telah mengirimkan tautan verifikasi ke email Anda. Klik tautan tersebut untuk mengaktifkan akun Anda.
                    </p>
                </div>

                <div class="text-[11px] font-medium opacity-60 tracking-wide">
                    &copy; 2024 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: CONTENT --}}
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
                        <h2 class="text-[22px] font-bold text-slate-800 tracking-tight">Verifikasi Email Anda</h2>
                        <p class="text-[12px] text-slate-500 mt-1.5 leading-relaxed max-w-[280px] mx-auto">
                            Sebelum memulai, verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan.
                        </p>
                    </div>
                </div>

                {{-- Email icon illustration --}}
                <div class="flex justify-center fade-in-up fade-in-up-d1">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-sky-50 to-blue-100 border border-sky-100 flex items-center justify-center shadow-lg shadow-sky-100/50">
                            <svg class="w-12 h-12 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-amber-400 border-2 border-white flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Success status --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 fade-in-up fade-in-up-d2">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-semibold text-emerald-700">Tautan verifikasi baru telah dikirimkan ke email Anda.</p>
                    </div>
                @endif

                {{-- Resend form --}}
                <form method="POST" action="{{ route('verification.send') }}" class="fade-in-up fade-in-up-d2">
                    @csrf
                    <button type="submit"
                            class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                {{-- Footer --}}
                <div class="pt-2 text-center fade-in-up fade-in-up-d3">
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-3 text-[10px] text-slate-400 font-bold tracking-widest uppercase">atau</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[11px] font-semibold text-slate-600 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-all group">
                            <svg class="h-[14px] w-[14px] text-slate-400 group-hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar dari Akun
                        </button>
                    </form>

                    <div class="mt-3">
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
