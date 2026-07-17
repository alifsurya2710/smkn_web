<x-guest-layout>
    @if(env('RECAPTCHA_SITE_KEY'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
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
        .fade-in-up-d2 { animation-delay: 0.10s; }
        .fade-in-up-d3 { animation-delay: 0.15s; }
        .fade-in-up-d4 { animation-delay: 0.20s; }
        .fade-in-up-d5 { animation-delay: 0.25s; }
        .fade-in-up-d6 { animation-delay: 0.30s; }
    </style>

    <div class="flex min-h-screen w-full font-sans bg-white">

        {{-- LEFT SIDE: BRANDING --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
            {{-- Background Image with Animated Gradient Overlay --}}
            <div class="absolute inset-0 z-0">
                @php $authBg = \App\Models\Setting::getByKey('auth_hero_image', 'images/hero-login.jpg'); @endphp
                <img src="{{ str_starts_with($authBg, 'images/') ? asset($authBg) : asset('storage/' . $authBg) }}"
                     class="h-full w-full object-cover object-center filter brightness-[0.55]"
                     style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;"
                     alt="SMKN 1 Katapang">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-indigo-800/30 to-slate-900/70 mix-blend-multiply animate-gradient-bg"></div>
            </div>

            {{-- Content Overlay --}}
            <div class="relative z-10 w-full flex flex-col justify-between p-12 lg:p-16 text-white h-full">
                {{-- Top Brand --}}
                <div>
                    <span class="text-[13px] font-bold tracking-widest uppercase opacity-90 drop-shadow-sm font-sans">SMKN 1 KATAPANG</span>
                </div>

                {{-- Main Text --}}
                <div class="max-w-xl pb-32">
                    <h1 class="text-[4rem] lg:text-[5rem] font-black leading-[1.05] tracking-tight mb-5 translate-y-8 drop-shadow-lg">
                        <span class="block text-white">Daftar</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 animate-gradient-bg">Sekarang</span>
                    </h1>
                    <p class="text-[15px] opacity-[0.85] leading-relaxed font-medium mt-6 max-w-sm text-slate-100 translate-y-8 font-sans">
                        "Buat akun untuk mengakses laporan siswa,<br>
                        pendaftaran SPMB, dan konten khusus<br>
                        program vokasional SMKN 1 Katapang"
                    </p>
                </div>

                {{-- Footer --}}
                <div class="text-[11px] font-medium opacity-60 font-sans tracking-wide">
                    &copy; 2026 SMK Negeri 1 Katapang
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: FORM --}}
        <div class="w-full lg:w-1/2 bg-white flex flex-col items-center justify-center p-6 sm:p-10 lg:p-16 relative overflow-y-auto">
            <div class="w-full max-w-[400px] space-y-5 my-8">

                {{-- Header --}}
                <div class="text-center space-y-4 flex flex-col items-center fade-in-up">
                    {{-- Logo --}}
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden drop-shadow-lg transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo SMKN 1 Katapang" class="h-full w-auto object-contain">
                    </div>
                    <h2 class="text-[22px] font-bold text-slate-800 tracking-tight font-sans">Buat Akun Baru</h2>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4 pt-1">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="space-y-1.5 fade-in-up fade-in-up-d1">
                        <label for="name" class="text-[10px] font-bold text-slate-600 tracking-wide">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Masukkan nama lengkap Anda"
                                   class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1.5 fade-in-up fade-in-up-d2">
                        <label for="email" class="text-[10px] font-bold text-slate-600 tracking-wide">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   placeholder="namaanda@example.com"
                                   class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    {{-- NISN & No Telepon (grid 2 col) --}}
                    <div class="grid grid-cols-2 gap-3 fade-in-up fade-in-up-d3">
                        {{-- NISN --}}
                        <div class="space-y-1.5">
                            <label for="nisn" class="text-[10px] font-bold text-slate-600 tracking-wide">NISN (Siswa)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <svg class="h-[14px] w-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <input id="nisn" type="text" name="nisn" value="{{ old('nisn') }}"
                                       placeholder="NISN Anda"
                                       class="block w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[12px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('nisn')" class="mt-1 text-xs" />
                        </div>
                        {{-- No Telepon --}}
                        <div class="space-y-1.5">
                            <label for="no_telp" class="text-[10px] font-bold text-slate-600 tracking-wide">Nomor Telepon</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <svg class="h-[14px] w-[14px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input id="no_telp" type="text" name="no_telp" value="{{ old('no_telp') }}"
                                       placeholder="0812..."
                                       class="block w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[12px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-1 text-xs" />
                        </div>
                    </div>

                    {{-- Kata Sandi --}}
                    <div class="space-y-1.5 fade-in-up fade-in-up-d4"
                         x-data="{
                            show: false,
                            pw: '',
                            get hasMin()    { return this.pw.length >= 8 },
                            get hasUpper()  { return /[A-Z]/.test(this.pw) },
                            get hasLower()  { return /[a-z]/.test(this.pw) },
                            get hasNumber() { return /[0-9]/.test(this.pw) },
                            get hasSymbol() { return /[@$!%*?&]/.test(this.pw) },
                            get allPass()   { return this.hasMin && this.hasUpper && this.hasLower && this.hasNumber && this.hasSymbol },
                         }">
                        <label for="password" class="text-[10px] font-bold text-slate-600 tracking-wide">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                                   x-model="pw"
                                   placeholder="Buat kata sandi yang kuat"
                                   class="block w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer transition-colors" @click="show = !show">
                                <svg x-show="!show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-cloak x-show="show" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </div>
                        </div>

                        {{-- Password strength checklist --}}
                        <div x-show="pw.length > 0" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="mt-2 p-3 bg-slate-50 rounded-lg border border-slate-100 space-y-1.5">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Syarat Kata Sandi</p>
                            <div class="grid grid-cols-2 gap-x-3 gap-y-1.5">
                                {{-- Min 8 karakter --}}
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasMin ? 'bg-emerald-500' : 'bg-slate-200'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                        <svg x-show="hasMin" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span :class="hasMin ? 'text-emerald-700' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Min. 8 karakter</span>
                                </div>
                                {{-- Huruf besar --}}
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasUpper ? 'bg-emerald-500' : 'bg-slate-200'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                        <svg x-show="hasUpper" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span :class="hasUpper ? 'text-emerald-700' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Huruf besar (A-Z)</span>
                                </div>
                                {{-- Huruf kecil --}}
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasLower ? 'bg-emerald-500' : 'bg-slate-200'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                        <svg x-show="hasLower" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span :class="hasLower ? 'text-emerald-700' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Huruf kecil (a-z)</span>
                                </div>
                                {{-- Angka --}}
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasNumber ? 'bg-emerald-500' : 'bg-slate-200'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                        <svg x-show="hasNumber" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span :class="hasNumber ? 'text-emerald-700' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Angka (0-9)</span>
                                </div>
                                {{-- Simbol --}}
                                <div class="flex items-center gap-1.5 col-span-2">
                                    <div :class="hasSymbol ? 'bg-emerald-500' : 'bg-slate-200'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                        <svg x-show="hasSymbol" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span :class="hasSymbol ? 'text-emerald-700' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Simbol (@$!%*?&)</span>
                                </div>
                            </div>
                            {{-- Progress bar --}}
                            <div class="mt-2 pt-2 border-t border-slate-100">
                                <div class="flex gap-1">
                                    <div :class="[hasMin, hasUpper, hasLower, hasNumber, hasSymbol].filter(Boolean).length >= 1 ? 'bg-red-400' : 'bg-slate-200'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                    <div :class="[hasMin, hasUpper, hasLower, hasNumber, hasSymbol].filter(Boolean).length >= 2 ? 'bg-orange-400' : 'bg-slate-200'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                    <div :class="[hasMin, hasUpper, hasLower, hasNumber, hasSymbol].filter(Boolean).length >= 3 ? 'bg-yellow-400' : 'bg-slate-200'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                    <div :class="[hasMin, hasUpper, hasLower, hasNumber, hasSymbol].filter(Boolean).length >= 4 ? 'bg-blue-400' : 'bg-slate-200'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                    <div :class="allPass ? 'bg-emerald-500' : 'bg-slate-200'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                </div>
                                <p class="text-[9px] font-bold mt-1 transition-colors duration-200"
                                   :class="{
                                       'text-red-500':    [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length <= 1,
                                       'text-orange-500': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 2,
                                       'text-yellow-600': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 3,
                                       'text-blue-600':   [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 4,
                                       'text-emerald-600': allPass,
                                   }">
                                    <span x-text="allPass ? 'Kata sandi kuat ✓' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length <= 1 ? 'Sangat lemah' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 2 ? 'Lemah' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 3 ? 'Cukup' : 'Hampir kuat'"></span>
                                </p>
                            </div>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    {{-- Konfirmasi Kata Sandi --}}
                    <div class="space-y-1.5 fade-in-up fade-in-up-d5" x-data="{ show2: false }">
                        <label for="password_confirmation" class="text-[10px] font-bold text-slate-600 tracking-wide">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <input id="password_confirmation" :type="show2 ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Masukkan kembali kata sandi Anda"
                                   class="block w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 text-[13px] placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all font-medium">
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer transition-colors" @click="show2 = !show2">
                                <svg x-show="!show2" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-cloak x-show="show2" class="h-[16px] w-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2 fade-in-up fade-in-up-d6">
                        {{-- reCAPTCHA --}}
                        @if(env('RECAPTCHA_SITE_KEY'))
                        <div class="flex justify-center mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        </div>
                        @if($errors->has('g-recaptcha-response'))
                            <p class="text-xs text-red-500 text-center mb-3">{{ $errors->first('g-recaptcha-response') }}</p>
                        @endif
                        @endif
                        <button type="submit"
                                class="w-full py-2.5 bg-black text-white rounded-lg text-[13px] font-bold tracking-wide hover:bg-slate-800 focus:ring-4 focus:ring-slate-200 active:scale-[0.98] transition-all flex justify-center items-center shadow-md">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                {{-- Footer --}}
                <div class="pt-4 text-center fade-in-up fade-in-up-d6">
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest font-black">
                            <a href="{{ route('login') }}" class="bg-white px-4 text-blue-600 hover:text-blue-800 transition-colors">
                                Sudah punya akun? Masuk
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ url('/') }}"
                           class="w-full py-2.5 px-3 border border-slate-200 rounded-lg flex items-center justify-center gap-2 text-[11px] font-semibold text-slate-600 hover:text-slate-800 hover:border-slate-300 hover:bg-slate-50 hover:shadow-sm transition-all group">
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
