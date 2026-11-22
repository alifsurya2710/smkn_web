@extends('layouts.landing')

@section('title', 'Informasi SPMB')

@section('content')
<!-- Hero Section -->
<div class="relative h-[40vh] min-h-[300px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        @if(isset($settings['ppdb_hero_image']))
            <img src="{{ asset('storage/' . $settings['ppdb_hero_image']) }}" class="w-full h-full object-cover animate-soft-zoom" alt="SPMB Hero">
        @else
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover animate-soft-zoom" alt="SPMB Hero">
        @endif
        <div class="absolute inset-0 bg-[#0D2461]/80 backdrop-blur-[2px] mix-blend-multiply"></div>
    </div>
    
    <div class="relative z-10 text-center px-4" data-aos="zoom-in">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 font-outfit uppercase tracking-tight">Informasi SPMB</h1>
        <nav class="flex justify-center space-x-2 text-gray-300 text-sm font-medium uppercase tracking-widest font-inter">
            <a href="{{ route('home') }}" class="hover:text-white transition">HOME</a>
            <span>&raquo;</span>
            <span class="text-white">SPMB</span>
        </nav>
    </div>
</div>

<!-- Main PPDB Section with Alpine Modal -->
<div x-data="{ 
    showModal: false, 
    activeImage: '',
    openRegisterModal: {{ $errors->any() ? 'true' : 'false' }},
    isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
    authTab: 'login', // 'login' | 'register'
    authLoading: false,
    authError: '',
    authSuccess: '',
    copied: false,
    pernahPaud: '0',
    selectedJalur: 'reguler',
    hasBuktiTransfer: false,

    get biayaNominal() {
        switch(this.selectedJalur) {
            case 'yatim': return 0;
            case 'kurang_mampu': return 50000;
            case 'prestasi': return 100000;
            default: return 150000;
        }
    },

    get formattedBiaya() {
        if (this.biayaNominal === 0) return 'GRATIS (Rp 0)';
        return 'Rp ' + this.biayaNominal.toLocaleString('id-ID');
    },

    // Form data login
    loginEmail: '',
    loginPassword: '',
    loginCaptcha: '',
    loginCaptchaQuestion: '...',
    showLoginPassword: false,

    // Form data register
    regStudentName: '',
    regName: '',
    regEmail: '',
    regPhone: '',
    regPassword: '',
    regPasswordConfirmation: '',
    regCaptcha: '',
    regCaptchaQuestion: '...',
    showRegPassword: false,
    showRegConfirmPassword: false,

    async fetchLoginCaptcha() {
        try {
            const res = await fetch('{{ route('spmb.captcha') }}?type=spmb_login');
            const data = await res.json();
            this.loginCaptchaQuestion = data.question;
            this.loginCaptcha = '';
        } catch(e) {}
    },

    async fetchRegisterCaptcha() {
        try {
            const res = await fetch('{{ route('spmb.captcha') }}?type=spmb_register');
            const data = await res.json();
            this.regCaptchaQuestion = data.question;
            this.regCaptcha = '';
        } catch(e) {}
    },

    // Password validation helpers
    get hasMin() { return this.regPassword.length >= 8; },
    get hasUpper() { return /[A-Z]/.test(this.regPassword); },
    get hasLower() { return /[a-z]/.test(this.regPassword); },
    get hasNumber() { return /[0-9]/.test(this.regPassword); },
    get hasSymbol() { return /[@$!%*?&]/.test(this.regPassword); },

    copyRekening(text) {
        navigator.clipboard.writeText(text);
        this.copied = true;
        setTimeout(() => this.copied = false, 2500);
    },

    async submitLogin() {
        this.authLoading = true;
        this.authError = '';
        this.authSuccess = '';
        try {
            const res = await fetch('{{ route('spmb.login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: this.loginEmail,
                    password: this.loginPassword,
                    math_captcha: this.loginCaptcha
                })
            });
            const data = await res.json();
            if (res.ok && data.success) {
                this.authSuccess = data.message;
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                if (data.errors) {
                    this.authError = Object.values(data.errors).flat().join('<br>');
                } else {
                    this.authError = data.message || 'Login gagal, periksa email dan kata sandi Anda.';
                }
                this.fetchLoginCaptcha();
            }
        } catch (e) {
            this.authError = 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.';
        } finally {
            this.authLoading = false;
        }
    },

    async submitRegister() {
        this.authLoading = true;
        this.authError = '';
        this.authSuccess = '';
        try {
            const res = await fetch('{{ route('spmb.register') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    student_name: this.regStudentName,
                    name: this.regName,
                    email: this.regEmail,
                    no_telp: this.regPhone,
                    password: this.regPassword,
                    password_confirmation: this.regPasswordConfirmation,
                    math_captcha: this.regCaptcha
                })
            });
            const data = await res.json();
            if (res.ok && data.success) {
                this.authSuccess = data.message;
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                if (data.errors) {
                    this.authError = Object.values(data.errors).flat().join('<br>');
                } else {
                    this.authError = data.message || 'Pendaftaran akun gagal.';
                }
                this.fetchRegisterCaptcha();
            }
        } catch (e) {
            this.authError = 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.';
        } finally {
            this.authLoading = false;
        }
    }
}">

    <!-- Status Pendaftaran Pengguna yang Sedang Login -->
    @if(isset($userApplication) && $userApplication)
    <div class="max-w-4xl mx-auto px-4 mt-8">
        <div class="rounded-3xl p-6 sm:p-8 shadow-xl border {{ $userApplication->status === 'approved' ? 'bg-emerald-50/90 border-emerald-300' : ($userApplication->status === 'rejected' ? 'bg-red-50/90 border-red-300' : 'bg-amber-50/90 border-amber-300') }}" data-aos="fade-up">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b {{ $userApplication->status === 'approved' ? 'border-emerald-200' : ($userApplication->status === 'rejected' ? 'border-red-200' : 'border-amber-200') }}">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest block {{ $userApplication->status === 'approved' ? 'text-emerald-700' : ($userApplication->status === 'rejected' ? 'text-red-700' : 'text-amber-700') }}">
                        Status Pengajuan SPMB Anda
                    </span>
                    <h3 class="text-xl font-black text-slate-900 mt-0.5 font-outfit">
                        {{ $userApplication->full_name }}
                    </h3>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">No. Pendaftaran: <strong>{{ $userApplication->registration_number }}</strong></p>
                </div>
                <div>
                    @if($userApplication->status === 'approved')
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-600 text-white shadow-md">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            DITERIMA (APPROVED)
                        </span>
                    @elseif($userApplication->status === 'rejected')
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-black uppercase tracking-wider bg-red-600 text-white shadow-md">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            BELUM DITERIMA (REJECTED)
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-black uppercase tracking-wider bg-amber-500 text-white shadow-md">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            MENUNGGU VERIFIKASI
                        </span>
                    @endif
                </div>
            </div>

            <div class="mt-4 text-xs leading-relaxed text-slate-700">
                @if($userApplication->status === 'approved')
                    <div class="p-4 bg-white/80 rounded-2xl border border-emerald-200">
                        <p class="font-bold text-emerald-900 text-sm mb-1">🎉 Selamat, Pendaftaran Ananda Diterima!</p>
                        <p class="text-emerald-800">Seluruh dokumen dan pembayaran telah diverifikasi. Kami juga telah mengirimkan email konfirmasi ke <strong>{{ $userApplication->email }}</strong>. Panitia akan segera menghubungi Anda via WhatsApp.</p>
                        @if($userApplication->catatan)
                            <div class="mt-2 pt-2 border-t border-emerald-100 text-emerald-900">
                                <span class="font-bold">Catatan Panitia:</span> {{ $userApplication->catatan }}
                            </div>
                        @endif
                    </div>
                @elseif($userApplication->status === 'rejected')
                    <div class="p-4 bg-white/80 rounded-2xl border border-red-200">
                        <p class="font-bold text-red-900 text-sm mb-1">⚠️ Mohon Maaf, Berkas Pendaftaran Ditolak</p>
                        <div class="p-3 bg-red-50 rounded-xl border border-red-200 text-red-800 my-2">
                            <span class="font-bold block uppercase text-[10px]">Alasan Penolakan:</span>
                            <p class="mt-0.5 font-medium">{{ $userApplication->catatan ?? 'Berkas yang diunggah belum memenuhi persyaratan.' }}</p>
                        </div>
                        <p class="text-slate-600">Pemberitahuan lengkap beserta alasan telah dikirimkan ke email Anda (<strong>{{ $userApplication->email }}</strong>). Anda dapat mengajukan pendaftaran ulang dengan klik tombol di bawah.</p>
                    </div>
                @else
                    <div class="p-4 bg-white/80 rounded-2xl border border-amber-200">
                        <p class="font-bold text-amber-900 text-sm mb-1">⏳ Berkas Sedang Diverifikasi oleh Panitia</p>
                        <p class="text-amber-800">Formulir pendaftaran dan berkas ananda telah kami terima. Admin & Super Admin sedang memeriksa keabsahan Kartu Keluarga, Akta Kelahiran, dan Bukti Pembayaran. Hasil verifikasi akan diumumkan di sini dan dikirimkan otomatis ke alamat Gmail Anda.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Alert Sukses Pendaftaran -->
    @if(session('success_spmb'))
    <div class="max-w-4xl mx-auto px-4 mt-8">
        <div class="bg-green-50 border-2 border-green-500 rounded-2xl p-6 text-center shadow-lg" data-aos="fade-down">
            <div class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-green-900 mb-2 font-outfit">Pendaftaran Berhasil Dikirim!</h3>
            <p class="text-green-800 text-sm font-medium">{{ session('success_spmb') }}</p>
        </div>
    </div>
    @endif

    <!-- Intro Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="flex items-center justify-center space-x-2 text-gray-500 mb-4">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                <span class="text-xs font-bold uppercase tracking-[0.3em] text-green-700">SPMB RA AL-IKHWAN</span>
            </div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0D2461] mb-6 font-outfit uppercase">Seleksi Penerimaan Murid Baru</h2>
            <div class="text-gray-600 leading-relaxed text-base font-inter space-y-4 mb-8">
                <p>Selamat datang di portal Penerimaan Murid Baru <strong>RA AL-IKHWAN</strong>. Kami membuka kesempatan bagi ananda tercinta untuk belajar dan bertumbuh dalam lingkungan pendidikan usia dini yang islami, ceria, dan berkarakter.</p>
                <p>Silakan klik tombol di bawah ini untuk mengisi formulir pendaftaran murid baru dan mengunggah dokumen persyaratan.</p>
            </div>

            <!-- CTA Button to Trigger Popup Form -->
            <div class="flex flex-col items-center justify-center gap-3">
                @if(isset($userApplication) && $userApplication)
                    @if($userApplication->status === 'approved')
                        <div class="inline-flex items-center gap-3 px-8 py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-600/30 text-sm uppercase tracking-wider cursor-default">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Pendaftaran Anda Telah Diterima
                        </div>
                        <p class="text-xs text-slate-500 font-medium">Ananda telah resmi diterima. Tidak perlu mengisi formulir kembali.</p>
                    @elseif($userApplication->status === 'pending')
                        <div class="inline-flex items-center gap-3 px-8 py-4 bg-amber-500 text-white font-bold rounded-2xl shadow-xl shadow-amber-500/30 text-sm uppercase tracking-wider cursor-default">
                            <svg class="w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Formulir Sudah Terkirim (Menunggu Verifikasi)
                        </div>
                        <p class="text-xs text-slate-500 font-medium">Anda sudah mengirimkan berkas pendaftaran. Silakan tunggu proses verifikasi panitia.</p>
                    @elseif($userApplication->status === 'rejected')
                        <button @click="openRegisterModal = true" class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl shadow-xl shadow-red-600/30 hover:scale-105 transition-all text-sm uppercase tracking-wider">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Kirim Ulang / Perbaiki Berkas Pendaftaran
                        </button>
                        <p class="text-xs text-red-600 font-medium">Pendaftaran sebelumnya ditolak. Klik tombol di atas untuk memperbaiki dan mengirim ulang berkas.</p>
                    @endif
                @else
                    <button @click="openRegisterModal = true" class="inline-flex items-center gap-3 px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-2xl shadow-xl shadow-green-600/30 hover:scale-105 transition-all text-sm uppercase tracking-wider">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Daftar Murid Baru Sekarang
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- Infographic Grid: JALUR & KATEGORI PENDAFTARAN -->
    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block py-1 px-3.5 rounded-full bg-green-100 text-green-700 font-bold text-xs uppercase tracking-widest border border-green-200 mb-2">Informasi Masuk RA</span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#0D2461] uppercase tracking-tight">JALUR &amp; KATEGORI PENDAFTARAN</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-xl mx-auto">Pilih dan sesuaikan dengan kategori calon peserta didik untuk informasi lengkap.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Reguler / Umum -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up">
                    <div class="p-2">
                        @php
                            $imgReguler = $settings['ppdb_reguler_image'] ?? $settings['ppdb_jadwal_image'] ?? null;
                            $srcReguler = $imgReguler ? asset('storage/' . $imgReguler) : 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068&auto=format&fit=crop';
                        @endphp
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden relative cursor-pointer" @click="activeImage = '{{ $srcReguler }}'; showModal = true">
                            <img src="{{ $srcReguler }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                            <div class="absolute inset-0 flex items-center justify-center p-6 bg-[#0D2461]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                                 <div class="text-center">
                                     <div class="bg-white/20 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3 border border-white/30">
                                         <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                     </div>
                                     <h3 class="text-white text-base font-bold uppercase tracking-wider font-outfit">Reguler / Umum</h3>
                                     <span class="text-xs text-blue-200 font-bold block mt-1">Rp 150.000</span>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1.5 font-inter">Jalur Masuk</p>
                        <a href="#" @click.prevent="activeImage = '{{ $srcReguler }}'; showModal = true" class="text-[#0D2461] font-bold text-xs border-b-2 border-transparent hover:border-blue-600 hover:text-blue-700 transition-all uppercase tracking-widest inline-block pb-0.5">Reguler / Umum &rarr;</a>
                    </div>
                </div>

                <!-- Card 2: Anak Yatim / Piatu -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-2">
                        @php
                            $imgYatim = $settings['ppdb_yatim_image'] ?? $settings['ppdb_alur_image'] ?? null;
                            $srcYatim = $imgYatim ? asset('storage/' . $imgYatim) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=2070&auto=format&fit=crop';
                        @endphp
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden relative cursor-pointer" @click="activeImage = '{{ $srcYatim }}'; showModal = true">
                            <img src="{{ $srcYatim }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            <div class="absolute inset-0 bg-emerald-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                            <div class="absolute inset-0 flex items-center justify-center p-6 bg-[#0D2461]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                                 <div class="text-center">
                                     <div class="bg-white/20 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3 border border-white/30">
                                         <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                     </div>
                                     <h3 class="text-white text-base font-bold uppercase tracking-wider font-outfit">Anak Yatim / Piatu</h3>
                                     <span class="text-xs text-emerald-300 font-bold block mt-1">GRATIS (Rp 0)</span>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1.5 font-inter">Jalur Afirmasi</p>
                        <a href="#" @click.prevent="activeImage = '{{ $srcYatim }}'; showModal = true" class="text-[#0D2461] font-bold text-xs border-b-2 border-transparent hover:border-emerald-600 hover:text-emerald-700 transition-all uppercase tracking-widest inline-block pb-0.5">Anak Yatim / Piatu &rarr;</a>
                    </div>
                </div>

                <!-- Card 3: Kurang Mampu -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-2">
                        @php
                            $imgMampu = $settings['ppdb_kurang_mampu_image'] ?? $settings['ppdb_kuota_image'] ?? null;
                            $srcMampu = $imgMampu ? asset('storage/' . $imgMampu) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop';
                        @endphp
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden relative cursor-pointer" @click="activeImage = '{{ $srcMampu }}'; showModal = true">
                            <img src="{{ $srcMampu }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            <div class="absolute inset-0 bg-amber-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                            <div class="absolute inset-0 flex items-center justify-center p-6 bg-[#0D2461]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                                 <div class="text-center">
                                     <div class="bg-white/20 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3 border border-white/30">
                                         <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                     </div>
                                     <h3 class="text-white text-base font-bold uppercase tracking-wider font-outfit">Kurang Mampu</h3>
                                     <span class="text-xs text-amber-300 font-bold block mt-1">Rp 50.000</span>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1.5 font-inter">KIP / SKTM</p>
                        <a href="#" @click.prevent="activeImage = '{{ $srcMampu }}'; showModal = true" class="text-[#0D2461] font-bold text-xs border-b-2 border-transparent hover:border-amber-600 hover:text-amber-700 transition-all uppercase tracking-widest inline-block pb-0.5">Kurang Mampu &rarr;</a>
                    </div>
                </div>

                <!-- Card 4: Berprestasi -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-2">
                        @php
                            $imgPrestasi = $settings['ppdb_prestasi_image'] ?? null;
                            $srcPrestasi = $imgPrestasi ? asset('storage/' . $imgPrestasi) : 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2071&auto=format&fit=crop';
                        @endphp
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden relative cursor-pointer" @click="activeImage = '{{ $srcPrestasi }}'; showModal = true">
                            <img src="{{ $srcPrestasi }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            <div class="absolute inset-0 bg-purple-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                            <div class="absolute inset-0 flex items-center justify-center p-6 bg-[#0D2461]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                                 <div class="text-center">
                                     <div class="bg-white/20 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3 border border-white/30">
                                         <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                     </div>
                                     <h3 class="text-white text-base font-bold uppercase tracking-wider font-outfit">Berprestasi</h3>
                                     <span class="text-xs text-purple-200 font-bold block mt-1">Rp 100.000</span>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1.5 font-inter">Akademik / Tahfidz</p>
                        <a href="#" @click.prevent="activeImage = '{{ $srcPrestasi }}'; showModal = true" class="text-[#0D2461] font-bold text-xs border-b-2 border-transparent hover:border-purple-600 hover:text-purple-700 transition-all uppercase tracking-widest inline-block pb-0.5">Berprestasi &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alpine Modal Gambar Brosur / Jadwal -->
    <div x-show="showModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#0D2461]/90 backdrop-blur-md" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
         
        <div class="relative w-full max-w-5xl max-h-[90vh] flex flex-col items-center justify-center p-4" @click.away="showModal = false">
            <button @click="showModal = false" class="absolute -top-12 right-0 text-white hover:text-red-400 transition-colors bg-white/10 rounded-full p-2" title="Tutup">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="bg-white p-2 rounded-xl shadow-2xl relative w-full h-full flex justify-center items-center overflow-hidden">
                <img :src="activeImage" class="max-w-full max-h-[85vh] object-contain rounded-lg">
            </div>
        </div>
    </div>

    <!-- POPUP MODAL SPMB -->
    <div x-show="openRegisterModal"
         x-cloak
         class="fixed inset-0 z-[1000] overflow-y-auto"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-[#0D2461]/85 backdrop-blur-sm" @click="openRegisterModal = false"></div>

        <!-- Modal Wrapper: scroll-safe, centered, padding untuk tidak nabrak navbar -->
        <div class="flex min-h-full items-start sm:items-center justify-center p-3 sm:p-6 pt-16 sm:pt-6">

        <!-- Modal Box -->
        <div class="relative w-full max-w-lg sm:max-w-xl bg-white rounded-2xl sm:rounded-3xl shadow-2xl z-10 my-4 border border-slate-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <!-- Header Modal -->
            <div class="bg-gradient-to-r from-[#0D2461] to-green-700 p-4 sm:p-5 text-white relative sticky top-0 z-10 rounded-t-2xl sm:rounded-t-3xl">
                <button @click="openRegisterModal = false" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain bg-white rounded-full p-1" alt="Logo">
                    <div>
                        <h3 class="text-lg font-bold font-outfit uppercase">Portal Pendaftaran SPMB</h3>
                        <p class="text-xs text-green-100">RA AL-IKHWAN Cingcin - Soreang</p>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 overflow-y-auto max-h-[70vh] sm:max-h-[75vh]">

                <template x-if="!isLoggedIn">
                    <!-- KHUSUS LOGIN & REGISTER AKUN PENDAFTAR SPMB (TERPISAH DARI GURU/ADMIN) -->
                    <div>
                        <!-- Switch Tabs (Masuk vs Daftar) -->
                        <div class="grid grid-cols-2 p-1.5 bg-slate-100 rounded-2xl mb-8 max-w-sm mx-auto gap-1">
                            <button type="button" 
                                    @click="authTab = 'login'; authError = ''; authSuccess = '';" 
                                    :class="authTab === 'login' ? 'bg-white text-green-700 font-bold shadow-md' : 'text-slate-500 font-medium hover:text-slate-800'"
                                    class="py-3 px-4 text-xs rounded-xl transition-all uppercase tracking-wider text-center flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Masuk / Login
                            </button>
                            <button type="button" 
                                    @click="authTab = 'register'; authError = ''; authSuccess = '';" 
                                    :class="authTab === 'register' ? 'bg-white text-green-700 font-bold shadow-md' : 'text-slate-500 font-medium hover:text-slate-800'"
                                    class="py-3 px-4 text-xs rounded-xl transition-all uppercase tracking-wider text-center flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Buat Akun
                            </button>
                        </div>

                        <!-- Feedback Box -->
                        <div x-show="authError" x-cloak class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-medium" x-html="authError"></div>
                        <div x-show="authSuccess" x-cloak class="mb-4 p-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl text-xs font-bold" x-text="authSuccess"></div>

                        <!-- FORM LOGIN PENDAFTAR -->
                        <div x-show="authTab === 'login'" x-cloak>
                            <div class="text-center mb-6">
                                <h4 class="text-base font-bold text-slate-800 font-outfit">Masuk ke Akun Pendaftar</h4>
                                <p class="text-xs text-slate-500 mt-1">Gunakan akun yang telah didaftarkan untuk melanjutkan pengisian formulir SPMB.</p>
                            </div>

                            <form @submit.prevent="submitLogin" class="space-y-4 max-w-md mx-auto">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                                    <input type="email" x-model="loginEmail" required placeholder="emailanda@example.com"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                 </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                                    <div class="relative">
                                        <input :type="showLoginPassword ? 'text' : 'password'" x-model="loginPassword" required placeholder="••••••••"
                                               class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                        <button type="button" @click="showLoginPassword = !showLoginPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                            <svg x-show="!showLoginPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg x-show="showLoginPassword" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Math Captcha SPMB Login -->
                                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl" x-init="fetchLoginCaptcha()">
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            Verifikasi Hitung Cepat
                                        </span>
                                        <button type="button" @click="fetchLoginCaptcha()" class="text-[10px] text-green-600 hover:underline">Ganti Soal</button>
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <div class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm font-extrabold text-[#0D2461] tracking-wider select-none font-mono" x-text="loginCaptchaQuestion">
                                            ...
                                        </div>
                                        <input type="number" x-model="loginCaptcha" required placeholder="Jawaban angka"
                                               class="block flex-1 py-2 px-3 bg-white border border-slate-200 rounded-lg text-slate-800 text-xs placeholder-slate-400 focus:ring-1 focus:ring-green-500 focus:border-green-500 font-medium">
                                    </div>
                                </div>

                                <button type="submit" :disabled="authLoading"
                                        class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                                    <span x-show="!authLoading">Masuk Sekarang</span>
                                    <span x-show="authLoading" x-cloak>Memproses...</span>
                                </button>
                                <p class="text-center text-xs text-slate-500 pt-2">
                                    Belum punya akun pendaftar? 
                                    <a href="#" @click.prevent="authTab = 'register'; authError = '';" class="font-bold text-green-600 hover:underline">Daftar Akun Baru</a>
                                </p>
                            </form>
                        </div>

                        <!-- FORM REGISTER PENDAFTAR (ORANG TUA / WALI) -->
                        <div x-show="authTab === 'register'" x-cloak>
                            <div class="text-center mb-6">
                                <h4 class="text-base font-bold text-slate-800 font-outfit">Pendaftaran Akun Wali / Orang Tua</h4>
                                <p class="text-xs text-slate-500 mt-1">Buat akun khusus untuk mendaftarkan ananda sebagai calon murid baru RA AL-IKHWAN.</p>
                            </div>

                            <form @submit.prevent="submitRegister" class="space-y-4 max-w-md mx-auto">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Calon Murid / Siswa <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="regStudentName" required placeholder="Contoh: Muhammad Rayhan"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Orang Tua / Wali <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="regName" required placeholder="Contoh: Rahmat Hidayat"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp / HP Aktif <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="regPhone" required placeholder="081234567890"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                                    <input type="email" x-model="regEmail" required placeholder="nama@email.com"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input :type="showRegPassword ? 'text' : 'password'" x-model="regPassword" required placeholder="Min. 8 karakter"
                                                   class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                            <button type="button" @click="showRegPassword = !showRegPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                                <svg x-show="!showRegPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showRegPassword" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Ulangi Sandi <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input :type="showRegConfirmPassword ? 'text' : 'password'" x-model="regPasswordConfirmation" required placeholder="Konfirmasi sandi"
                                                   class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                            <button type="button" @click="showRegConfirmPassword = !showRegConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                                <svg x-show="!showRegConfirmPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showRegConfirmPassword" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Checklist Indicators -->
                                <div x-show="regPassword.length > 0" x-cloak
                                     class="p-3.5 bg-slate-50 rounded-xl border border-slate-200/80 space-y-2">
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ketentuan Kata Sandi</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-3 gap-y-1.5 text-[11px]">
                                        <!-- Minimal 8 karakter -->
                                        <div class="flex items-center gap-2">
                                            <div :class="hasMin ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-colors">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <span :class="hasMin ? 'text-emerald-700 font-semibold' : 'text-slate-400'">Minimal 8 karakter</span>
                                        </div>
                                        <!-- Huruf besar -->
                                        <div class="flex items-center gap-2">
                                            <div :class="hasUpper ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-colors">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <span :class="hasUpper ? 'text-emerald-700 font-semibold' : 'text-slate-400'">Huruf besar (A-Z)</span>
                                        </div>
                                        <!-- Huruf kecil -->
                                        <div class="flex items-center gap-2">
                                            <div :class="hasLower ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-colors">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <span :class="hasLower ? 'text-emerald-700 font-semibold' : 'text-slate-400'">Huruf kecil (a-z)</span>
                                        </div>
                                        <!-- Angka -->
                                        <div class="flex items-center gap-2">
                                            <div :class="hasNumber ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-colors">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <span :class="hasNumber ? 'text-emerald-700 font-semibold' : 'text-slate-400'">Angka (0-9)</span>
                                        </div>
                                        <!-- Simbol -->
                                        <div class="flex items-center gap-2 sm:col-span-2">
                                            <div :class="hasSymbol ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-colors">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <span :class="hasSymbol ? 'text-emerald-700 font-semibold' : 'text-slate-400'">Simbol (@$!%*?&)</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Math Captcha SPMB Register -->
                                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl" x-init="fetchRegisterCaptcha()">
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            Verifikasi Hitung Cepat
                                        </span>
                                        <button type="button" @click="fetchRegisterCaptcha()" class="text-[10px] text-green-600 hover:underline">Ganti Soal</button>
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <div class="px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm font-extrabold text-[#0D2461] tracking-wider select-none font-mono" x-text="regCaptchaQuestion">
                                            ...
                                        </div>
                                        <input type="number" x-model="regCaptcha" required placeholder="Jawaban angka"
                                               class="block flex-1 py-2 px-3 bg-white border border-slate-200 rounded-lg text-slate-800 text-xs placeholder-slate-400 focus:ring-1 focus:ring-green-500 focus:border-green-500 font-medium">
                                    </div>
                                </div>

                                <button type="submit" :disabled="authLoading"
                                        class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                                    <span x-show="!authLoading">Daftar Akun Baru</span>
                                    <span x-show="authLoading" x-cloak>Mendaftarkan...</span>
                                </button>
                                <p class="text-center text-xs text-slate-500 pt-2">
                                    Sudah punya akun? 
                                    <a href="#" @click.prevent="authTab = 'login'; authError = '';" class="font-bold text-green-600 hover:underline">Masuk di Sini</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </template>

                <template x-if="isLoggedIn">
                    <!-- JIKA SUDAH LOGIN: TAMPILKAN FORMULIR SPMB DENGAN BERKAS & PEMBAYARAN -->
                    <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Profil Pendaftar yang Sedang Login -->
                        <div class="flex items-center justify-between p-3.5 bg-green-50/70 border border-green-200 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-600 text-white font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Masuk sebagai: {{ Auth::user()->name ?? '' }}</p>
                                    <p class="text-[11px] text-slate-500">{{ Auth::user()->email ?? '' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-green-700 bg-green-100 px-2.5 py-1 rounded-full uppercase tracking-wider">Akun Terverifikasi</span>
                        </div>

                        <!-- Box Informasi Rekening & Pilihan Jalur Biaya Pendaftaran -->
                        <div class="p-4 sm:p-5 rounded-2xl bg-blue-50/60 border border-blue-200 shadow-sm space-y-4" x-data="{ localCopied: false }">
                            <!-- Pilihan Kategori / Jalur Pendaftaran -->
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                                    <span>PILIH JALUR & KATEGORI PENDAFTARAN</span>
                                    <span class="text-xs font-extrabold text-green-700 bg-green-100 px-2.5 py-0.5 rounded-full" x-text="'Biaya: ' + formattedBiaya"></span>
                                </label>
                                <p class="text-[11px] text-slate-500 mb-2.5">Biaya pendaftaran disesuaikan dengan kondisi dan jalur calon murid:</p>

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    <!-- Reguler -->
                                    <label class="cursor-pointer border-2 rounded-xl p-2.5 text-center transition-all flex flex-col justify-between"
                                           :class="selectedJalur === 'reguler' ? 'border-blue-600 bg-blue-50/80 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                        <input type="radio" name="jalur_pendaftaran" value="reguler" x-model="selectedJalur" class="sr-only">
                                        <span class="text-[11px] font-bold text-slate-800 block">Reguler / Umum</span>
                                        <span class="text-xs font-black text-blue-700 mt-1 block">Rp 150.000</span>
                                    </label>

                                    <!-- Anak Yatim -->
                                    <label class="cursor-pointer border-2 rounded-xl p-2.5 text-center transition-all flex flex-col justify-between"
                                           :class="selectedJalur === 'yatim' ? 'border-emerald-600 bg-emerald-50/80 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                        <input type="radio" name="jalur_pendaftaran" value="yatim" x-model="selectedJalur" class="sr-only">
                                        <span class="text-[11px] font-bold text-slate-800 block">Anak Yatim / Piatu</span>
                                        <span class="text-xs font-black text-emerald-700 mt-1 block">GRATIS (Rp 0)</span>
                                    </label>

                                    <!-- Kurang Mampu -->
                                    <label class="cursor-pointer border-2 rounded-xl p-2.5 text-center transition-all flex flex-col justify-between"
                                           :class="selectedJalur === 'kurang_mampu' ? 'border-amber-600 bg-amber-50/80 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                        <input type="radio" name="jalur_pendaftaran" value="kurang_mampu" x-model="selectedJalur" class="sr-only">
                                        <span class="text-[11px] font-bold text-slate-800 block">Kurang Mampu</span>
                                        <span class="text-xs font-black text-amber-700 mt-1 block">Rp 50.000</span>
                                    </label>

                                    <!-- Jalur Prestasi -->
                                    <label class="cursor-pointer border-2 rounded-xl p-2.5 text-center transition-all flex flex-col justify-between"
                                           :class="selectedJalur === 'prestasi' ? 'border-purple-600 bg-purple-50/80 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                        <input type="radio" name="jalur_pendaftaran" value="prestasi" x-model="selectedJalur" class="sr-only">
                                        <span class="text-[11px] font-bold text-slate-800 block">Berprestasi</span>
                                        <span class="text-xs font-black text-purple-700 mt-1 block">Rp 100.000</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Detail Rekening Pembayaran -->
                            <div class="pt-2 border-t border-blue-200/60">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0 mt-0.5 shadow-sm overflow-hidden">
                                        <img src="{{ asset('images/logo-bri.png') }}" alt="BRI" class="w-9 h-9 object-contain">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs font-bold text-blue-950 uppercase tracking-wider">Rekening Pembayaran Pendaftaran SPMB</h4>
                                        <p class="text-xs text-blue-800 mt-0.5">
                                            Total Biaya: <strong class="text-slate-900" x-text="formattedBiaya"></strong>. 
                                            <span x-show="selectedJalur !== 'yatim'">Silakan transfer ke rekening resmi berikut:</span>
                                            <span x-show="selectedJalur === 'yatim'" class="text-emerald-700 font-semibold">Khusus anak yatim bebas biaya pendaftaran. Cukup lampirkan surat/surat keterangan saat upload bukti.</span>
                                        </p>
                                        
                                        <div class="mt-3 bg-white p-3.5 rounded-xl border border-blue-200/80 shadow-sm space-y-3">
                                            <!-- Bank Info Row -->
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset('images/logo-bri.png') }}" alt="Bank BRI" class="h-7 object-contain">
                                                <div>
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Bank Rakyat Indonesia (BRI)</span>
                                                </div>
                                            </div>
                                            <!-- Nomor & Salin -->
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                                <div>
                                                    <span class="text-base sm:text-lg font-extrabold text-slate-900 tracking-wider font-mono">000501114505508</span>
                                                    <span class="text-xs font-semibold text-slate-600 block mt-0.5">a.n. Arip Budiman Salman</span>
                                                </div>
                                                <button type="button" 
                                                        @click="
                                                            navigator.clipboard.writeText('000501114505508');
                                                            localCopied = true;
                                                            setTimeout(() => localCopied = false, 2500);
                                                        " 
                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all shadow-sm active:scale-95 w-full sm:w-auto"
                                                        :class="localCopied ? 'bg-emerald-600 text-white' : 'bg-[#1a3fa0] hover:bg-[#163490] text-white'">
                                                    <svg x-show="!localCopied" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                    <svg x-show="localCopied" x-cloak class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span x-text="localCopied ? 'Tersalin!' : 'Salin Nomor Rekening'"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Calon Murid -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2">1. Data Calon Murid & Wali</h4>
                            
                            <!-- Pilihan Jalur Pendaftaran (Hidden / Bind to Selected) -->
                            <input type="hidden" name="jalur_pendaftaran" :value="selectedJalur">

                            <div>
                                <label for="full_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Murid <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" id="full_name" required value="{{ old('full_name', session('spmb_student_name') ?? (Auth::user() && Auth::user()->hasRole('pendaftar') ? Auth::user()->name : '')) }}"
                                       placeholder="Contoh: Muhammad Rayhan"
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="parent_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Orang Tua / Wali <span class="text-red-500">*</span></label>
                                    <input type="text" name="parent_name" id="parent_name" required value="{{ old('parent_name', Auth::user()->name ?? '') }}"
                                           placeholder="Nama ayah / ibu / wali"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                    @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="phone" id="phone" required value="{{ old('phone', Auth::user()->no_telp ?? '') }}"
                                           placeholder="08123456789"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="nisn" class="block text-xs font-bold text-slate-700 mb-1">NISN (Jika sudah memiliki / Opsional)</label>
                                <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}"
                                       placeholder="Masukkan NISN jika ada"
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                        </div>

                        <!-- Riwayat Pendidikan Sebelumnya -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2">2. Riwayat Pendidikan</h4>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">Pernah Menempuh Pendidikan PAUD / KB? <span class="text-red-500">*</span></label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200">
                                        <input type="radio" name="pernah_paud" value="1" x-model="pernahPaud" class="text-green-600 focus:ring-green-500">
                                        <span class="text-xs font-semibold text-slate-800">Ya, Pernah</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200">
                                        <input type="radio" name="pernah_paud" value="0" x-model="pernahPaud" class="text-green-600 focus:ring-green-500">
                                        <span class="text-xs font-semibold text-slate-800">Tidak / Belum Pernah</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Berkas & Pembayaran -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2">3. Upload Berkas Persyaratan & Pembayaran</h4>
                            
                            <!-- Foto KK -->
                            <div>
                                <label for="foto_kk" class="block text-xs font-bold text-slate-700 mb-1">Foto / Scan Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                                <input type="file" name="foto_kk" id="foto_kk" required accept="image/*,.pdf"
                                       class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, atau PDF (Maks. 5MB)</p>
                                @error('foto_kk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Foto Akta -->
                            <div>
                                <label for="foto_akta" class="block text-xs font-bold text-slate-700 mb-1">Foto / Scan Akta Kelahiran <span class="text-red-500">*</span></label>
                                <input type="file" name="foto_akta" id="foto_akta" required accept="image/*,.pdf"
                                       class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, atau PDF (Maks. 5MB)</p>
                                @error('foto_akta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Foto Rapot PAUD (Kondisional jika pernah PAUD) -->
                            <div x-show="pernahPaud === '1'" x-transition class="p-4 bg-green-50/50 rounded-xl border border-green-100">
                                <label for="foto_rapot_paud" class="block text-xs font-bold text-slate-700 mb-1">Foto / Scan Rapot / Keterangan PAUD <span class="text-red-500">*</span></label>
                                <input type="file" name="foto_rapot_paud" id="foto_rapot_paud" accept="image/*,.pdf" :required="pernahPaud === '1'"
                                       class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-[10px] text-slate-400 mt-1">Wajib diunggah jika ananda pernah menempuh PAUD sebelumnya.</p>
                                @error('foto_rapot_paud') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Bukti Transaksi Pembayaran -->
                            <div>
                                <label for="bukti_transfer" class="block text-xs font-bold text-slate-700 mb-1">Bukti Transaksi Pembayaran <span class="text-red-500">*</span></label>
                                <input type="file" name="bukti_transfer" id="bukti_transfer" required accept="image/*,.pdf"
                                       @change="hasBuktiTransfer = $event.target.files.length > 0"
                                       class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-[10px] text-slate-400 mt-1">Unggah struk ATM / mutasi m-banking / bukti setor tunai.</p>
                                <p x-show="!hasBuktiTransfer" class="text-[11px] font-medium text-amber-600 mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 inline shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    Wajib memilih file bukti transfer pembayaran agar tombol kirim dapat diklik.
                                </p>
                                @error('bukti_transfer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 border-t border-slate-100 flex flex-col-reverse sm:flex-row gap-2.5 sm:justify-end">
                            <button type="button" @click="openRegisterModal = false" class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors text-center">
                                Batal
                            </button>
                            <button type="submit" 
                                    :disabled="!hasBuktiTransfer"
                                    :class="hasBuktiTransfer ? 'bg-green-600 hover:bg-green-700 text-white cursor-pointer shadow-md' : 'bg-slate-300 text-slate-500 cursor-not-allowed opacity-60'"
                                    class="w-full sm:w-auto px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all text-center flex items-center justify-center gap-2">
                                <span>Kirim Formulir Pendaftaran</span>
                            </button>
                        </div>
                    </form>
                </template>

            </div>
        </div>

        </div>{{-- end flex wrapper --}}
    </div>

</div>
@endsection
