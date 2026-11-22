@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 flex flex-col justify-center overflow-hidden bg-[#0D2461]">
        <!-- Background Overlay Image -->
        <div class="absolute inset-0 z-0">
             @if($profile && $profile->about_hero_image)
                 <img src="{{ asset('storage/' . $profile->about_hero_image) }}" alt="Tentang RA AL-IKHWAN" class="w-full h-full object-cover opacity-25">
             @else
                 <img src="{{ asset('images/school-building.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop'" alt="RA AL-IKHWAN Building" class="w-full h-full object-cover opacity-25">
             @endif
             <div class="absolute inset-0 bg-gradient-to-b from-[#0D2461]/90 via-[#0D2461]/80 to-[#0D2461]"></div>
        </div>

        <!-- Ambient Glow Decoration -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-green-500 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-blue-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center w-full">
            <span class="inline-block py-1.5 px-4 rounded-full bg-green-500/10 border border-green-400/30 text-green-400 font-bold uppercase tracking-[0.25em] text-[10px] md:text-xs mb-6">
                Profil & Informasi Lembaga
            </span>
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-white font-outfit uppercase tracking-tight leading-tight md:leading-tight mb-6 max-w-4xl mx-auto">
                {!! $profile->about_hero_title ?? 'Membangun Generasi Islami yang Berkarakter' !!}
            </h1>
            <p class="text-sm sm:text-base md:text-lg text-blue-100/90 max-w-2xl mx-auto leading-relaxed mb-10 font-inter">
                {{ $profile->about_hero_description ?? 'Membimbing dan mendidik putra-putri usia dini dengan nilai-nilai islami, kemandirian, dan kasih sayang untuk masa depan yang gemilang.' }}
            </p>

            <!-- Stats Bar (Normal in flow, no translate overlap) -->
            <div class="bg-white/10 backdrop-blur-xl rounded-2xl sm:rounded-3xl p-5 sm:p-8 max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 shadow-2xl border border-white/15">
                <div class="flex flex-col items-center border-r border-white/15 last:border-0"
                    x-data="{ count: 0, target: 120 }"
                    x-init="let start = 0; let duration = 1500; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
                    <h3 class="text-2xl sm:text-4xl font-black text-white font-outfit mb-1" x-text="count + '+'">120+</h3>
                    <p class="text-[10px] sm:text-xs text-green-300 font-bold uppercase tracking-widest text-center">
                        Peserta Didik
                    </p>
                </div>

                <div class="flex flex-col items-center md:border-r border-white/15 last:border-0"
                    x-data="{ count: 0, target: 15 }"
                    x-init="let start = 0; let duration = 1500; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
                    <h3 class="text-2xl sm:text-4xl font-black text-white font-outfit mb-1" x-text="count + ''">15</h3>
                    <p class="text-[10px] sm:text-xs text-green-300 font-bold uppercase tracking-widest text-center">
                        Pendidik & Staf
                    </p>
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col items-center pt-2 md:pt-0 border-t md:border-t-0 border-white/15"
                    x-data="{ count: 0, target: 100 }"
                    x-init="let start = 0; let duration = 1500; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
                    <h3 class="text-2xl sm:text-4xl font-black text-white font-outfit mb-1" x-text="count + '%'">100%</h3>
                    <p class="text-[10px] sm:text-xs text-green-300 font-bold uppercase tracking-widest text-center">
                        Pendidikan Islami
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0D2461] mb-4 font-outfit relative inline-block">
                Visi & Misi Kami
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1.5 bg-gray-200 rounded-full"></div>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-20">
                <!-- Visi Card -->
                <div class="bg-[#F8F9FB] rounded-[2rem] p-12 text-left shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-[#0D2461] mb-6 font-outfit">Visi RA AL-IKHWAN</h3>
                    <p class="text-gray-600 leading-relaxed text-lg font-inter italic">
                        "{{ $profile->vision ?? 'Menjadi lembaga pendidikan anak usia dini (Raudhatul Athfal) yang unggul, berakhlak mulia, cerdas, kreatif, mandiri, serta berlandaskan nilai-nilai Qurani.' }}"
                    </p>
                </div>

                <!-- Misi Card -->
                <div class="bg-[#F8F9FB] rounded-[2rem] p-12 text-left shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-[#0D2461] mb-6 font-outfit">Misi RA AL-IKHWAN</h3>
                    <ul class="space-y-4 text-gray-600 font-inter">
                        @if($profile && $profile->mission)
                            @foreach($profile->mission as $m)
                                <li class="flex items-start gap-3">
                                    <span class="text-green-600 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></span>
                                    <span>{{ $m }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start gap-4">
                                <span class="text-green-600 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                <span>Menanamkan akidah, akhlakul karimah, dan pembiasaan ibadah praktis sejak usia dini.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="text-green-600 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                <span>Mengembangkan potensi kecerdasan, motorik, bahasa, dan kreativitas anak melalui bermain sambil belajar.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="text-green-600 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                <span>Menciptakan lingkungan belajar yang aman, ramah anak, dan penuh kasih sayang.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Sambutan Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-16 md:gap-24">
                <div class="w-full md:w-[40%] relative">
                    <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[4/5]">
                        @if($profile && $profile->principal_photo)
                            <img src="{{ asset('storage/' . $profile->principal_photo) }}" alt="Kepala Yayasan" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->principal_name ?? 'Arip Budiman Muslim') }}&color=1e3a8a&background=e2e8f0&size=512" alt="Kepala Yayasan" class="w-full h-full object-cover grayscale">
                        @endif
                    </div>
                    <!-- Decorative back frame -->
                    <div class="absolute -top-4 -left-4 w-full h-full border-2 border-gray-200 rounded-[2.5rem] z-0"></div>
                </div>
                
                <div class="w-full md:w-[60%]">
                    <div class="text-gray-400 font-bold tracking-[0.2em] uppercase text-xs mb-4">Sambutan Hangat</div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-[#0D2461] mb-8 font-outfit">Pesan dari {{ $profile->principal_title ?? 'Kepala Yayasan' }}</h2>
                    <div class="text-gray-600 mb-10 font-inter leading-relaxed text-lg italic">
                        @if($profile && $profile->principal_message)
                            {!! nl2br(e($profile->principal_message)) !!}
                        @else
                            <p class="mb-6">"Selamat datang di RA AL-IKHWAN. Kami berkomitmen untuk memberikan layanan pendidikan terbaik yang menanamkan nilai-nilai karakter, akhlak mulia, serta membimbing tumbuh kembang anak secara optimal."</p>
                            <p>"Kami berkomitmen untuk terus berinovasi dalam metode pembelajaran sesuai dengan dinamika dan kompetensi yang dibutuhkan oleh bidang guru, pemangku kepentingan dan lembaga negara bangsa."</p>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-gray-900 font-outfit uppercase">{{ $profile->principal_name ?? 'Arip Budiman Muslim, S.Pd.I.' }}</h4>
                        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">{{ $profile->principal_title ?? 'Kepala Yayasan' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section class="py-24 bg-[#FBFCFE]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#0D2461] mb-4 font-outfit">Sejarah Singkat</h2>
                <p class="text-gray-400 font-medium font-inter">Perjalanan transformasi dan dedikasi kami sejak tahun 1999/2000.</p>
            </div>

            <div class="max-w-4xl mx-auto relative border-l-2 border-gray-200 ml-4 md:ml-auto">
                <!-- Timeline items -->
                <div class="space-y-16">
                    <!-- Item 1 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0D2461] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">1999/2000</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Awal Perjalanan</h4>
                                <p class="text-gray-500 leading-relaxed font-inter">Mulai menerima siswa tahun ajaran 1999/2000 (saat itu bernama SMKN 4 Soreang) dengan jurusan Teknik Mesin/Perkakas. Kegiatan belajar mengajar dilaksanakan di SMPN 1 Katapang.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0D2461] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">2000</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Peresmian Sekolah</h4>
                                <p class="text-gray-500 leading-relaxed font-inter">Resmi berdiri berdasarkan SK No. 217/O/2000 tanggal 17 November 2000 dan ditetapkan sebagai RA AL-IKHWAN..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0D2461] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">2000/2015</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Penambahan Bidang Program</h4>
                                <p class="text-gray-500 leading-relaxed font-inter">prestasi dan Ekspansi program siswa aktif meraih prestasi di bidang Pramuka tingkat Kabupaten & Provinsi serta mengikuti LKS tingkat Provinsi dan Nasional.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0D2461] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">Sekarang</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Transformasi Digital</h4>
                                <p class="text-gray-500 leading-relaxed font-inter"> Berkomitmen menyiapkan generasi unggul, berkarakter islami, mandiri, kreatif, dan adaptif.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    @if(isset($facilities) && $facilities->count() > 0)
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-[#0D2461] mb-4 font-outfit uppercase">Fasilitas Unggulan</h2>
                    <p class="text-gray-400 font-medium">Fasilitas terbaik untuk mendukung kegiatan belajar dan bermain anak RA AL-IKHWAN.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($facilities as $facility)
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    @if($facility->image)
                    <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}" class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                    <div class="w-full h-[450px] bg-[#0D2461]/10 flex items-center justify-center">
                        <svg class="w-20 h-20 text-[#0D2461]/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0D2461]/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase tracking-tight">{{ $facility->name }}</h3>
                        <p class="text-gray-300 text-sm font-inter line-clamp-2">{{ $facility->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
