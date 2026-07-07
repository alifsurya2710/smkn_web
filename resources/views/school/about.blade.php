@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[400px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
             @if($profile && $profile->about_hero_image)
                 <img src="{{ asset('storage/' . $profile->about_hero_image) }}" alt="Tentang SMKN 1 Katapang" class="w-full h-full object-cover">
             @else
                 <img src="{{ asset('images/school-building.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop'" alt="SMKN 1 Katapang Building" class="w-full h-full object-cover">
             @endif
             <div class="absolute inset-0 bg-[#0A142F]/60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-7xl font-extrabold mb-6 text-white drop-shadow-lg font-outfit">
                {!! $profile->about_hero_title ?? 'Membangun Masa<br/>Depan Gemilang' !!}
            </h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed mb-12 font-inter">
                {{ $profile->about_hero_description ?? 'Menjadi lembaga pendidikan vokasi terdepan yang menghasilkan lulusan kompeten, berkarakter, dan siap menghadapi tantangan global.' }}
            </p>

          <!-- Stats Bar Overlay -->
<div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 md:p-8 max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-8 shadow-xl border border-white/20 transform translate-y-1/2">
    
    <div class="flex flex-col items-center border-r border-white/20 last:border-0"
        x-data="{ count: 0, target: 1800 }"
        x-init="let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
        
        <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-1 font-outfit"
            x-text="(count/1000).toFixed(1) + '">1800</h3>
        
        <p class="text-[10px] md:text-xs text-white/70 font-bold uppercase tracking-widest">
            Siswa Aktif
        </p>
    </div>

    <div class="flex flex-col items-center border-r border-white/20 last:border-0"
        x-data="{ count: 0, target:115 }"
        x-init="let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
        
        <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-1 font-outfit"
            x-text="count + ''">115</h3>
        
        <p class="text-[10px] md:text-xs text-white/70 font-bold uppercase tracking-widest">
            Pengajar & Staf
        </p>
    </div>

    <div class="flex flex-col items-center"
        x-data="{ count: 0, target: 100 }"
        x-init="let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16)">
        
        <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-1 font-outfit"
            x-text="count + ''">100</h3>
        
        <p class="text-[10px] md:text-xs text-white/70 font-bold uppercase tracking-widest">
            Mitra Industri
        </p>
    </div>

</div>
    </section>

    <div class="h-32"></div>

    <!-- Visi & Misi Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit relative inline-block">
                Visi & Misi Kami
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1.5 bg-gray-200 rounded-full"></div>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-20">
                <!-- Visi Card -->
                <div class="bg-[#F8F9FB] rounded-[2rem] p-12 text-left shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-6 font-outfit">Visi Sekolah</h3>
                    <p class="text-gray-600 leading-relaxed text-lg font-inter italic">
                        "{{ $profile->vision ?? 'Menjadi institusi pendidikan kejuruan yang unggul, menghasilkan lulusan berkarakter, mandiri, dan berbudaya lingkungan yang mampu bersaing di era global.' }}"
                    </p>
                </div>

                <!-- Misi Card -->
                <div class="bg-[#F8F9FB] rounded-[2rem] p-12 text-left shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-6 font-outfit">Misi Sekolah</h3>
                    <ul class="space-y-4 text-gray-600 font-inter">
                        @if($profile && $profile->mission)
                            @foreach($profile->mission as $m)
                                <li class="flex items-start gap-3">
                                    <span class="text-blue-500 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></span>
                                    <span>{{ $m }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start gap-4">
                                <span class="text-blue-500 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                <span>Menyelenggarakan pendidikan berbasis kompetensi sesuai tuntutan industri.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="text-blue-500 mt-1"><svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                <span>Menanamkan nilai-nilai religius dan karakter budaya bangsa pada seluruh komponen sekolah.</span>
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
                            <img src="{{ asset('storage/' . $profile->principal_photo) }}" alt="Kepala Sekolah" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->principal_name ?? 'Hendra Hermansah') }}&color=1e3a8a&background=e2e8f0&size=512" alt="Kepala Sekolah" class="w-full h-full object-cover grayscale">
                        @endif
                    </div>
                    <!-- Decorative back frame -->
                    <div class="absolute -top-4 -left-4 w-full h-full border-2 border-gray-200 rounded-[2.5rem] z-0"></div>
                </div>
                
                <div class="w-full md:w-[60%]">
                    <div class="text-gray-400 font-bold tracking-[0.2em] uppercase text-xs mb-4">Sambutan Hangat</div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-8 font-outfit">Pesan dari Kepala Sekolah</h2>
                    <div class="text-gray-600 mb-10 font-inter leading-relaxed text-lg italic">
                        @if($profile && $profile->principal_message)
                            {!! nl2br(e($profile->principal_message)) !!}
                        @else
                            <p class="mb-6">"Selamat datang di SMKN 1 Katapang. Sejak berdiri pada tahun 1999, kami terus berkomitmen untuk memberikan layanan pendidikan vokasi terbaik. Kami meyakini bahwa pendidikan bukan sekadar transfer ilmu dan keterampilan, tetapi juga proses membangun karakter, menumbuhkan semangat berprestasi, serta menyiapkan generasi muda siap menghadapi dunia kerja dan industri."</p>
                            <p>"Kami berkomitmen untuk terus berinovasi dalam metode pembelajaran sesuai dengan dinamika dan kompetensi yang dibutuhkan oleh bidang guru, pemangku kepentingan dan lembaga negara bangsa."</p>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-gray-900 font-outfit uppercase">{{ $profile->principal_name ?? 'Hendra Hermansah, S.Pd., M.M' }}</h4>
                        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section class="py-24 bg-[#FBFCFE]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit">Sejarah Singkat</h2>
                <p class="text-gray-400 font-medium font-inter">Perjalanan transformasi dan dedikasi kami sejak tahun 1999/2000.</p>
            </div>

            <div class="max-w-4xl mx-auto relative border-l-2 border-gray-200 ml-4 md:ml-auto">
                <!-- Timeline items -->
                <div class="space-y-16">
                    <!-- Item 1 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0A142F] border-4 border-white"></div>
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
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0A142F] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">2000</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Peresmian Sekolah</h4>
                                <p class="text-gray-500 leading-relaxed font-inter">Resmi berdiri berdasarkan SK No. 217/O/2000 tanggal 17 November 2000 dan ditetapkan sebagai SMKN 1 Katapang..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="relative pl-12">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0A142F] border-4 border-white"></div>
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
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#0A142F] border-4 border-white"></div>
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="shrink-0 w-32">
                                <span class="text-2xl font-extrabold text-gray-900 font-outfit">Sekarang</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-extrabold text-gray-900 mb-2 font-outfit">Transformasi Digital</h4>
                                <p class="text-gray-500 leading-relaxed font-inter"> Memiliki program keahlian seperti Teknik Elektronika Industri, Teknik Mesin, Teknik Kendaraan Ringan, Teknik Penyempurnaan Tekstil, Teknik Jaringan Komputer, RPL, dan Broadcasting. Berkomitmen menyiapkan generasi unggul, berkarakter kebangsaan, kompetitif, dan adaptif..</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase">Fasilitas Unggulan</h2>
                    <p class="text-gray-400 font-medium">Mendukung pembelajaran praktek siswa dengan standar industri mutakhir.</p>
                </div>
                <a href="#" class="text-sm font-bold text-gray-900 border-b-2 border-gray-900 pb-1 hover:text-blue-600 hover:border-blue-600 transition-all uppercase tracking-widest hidden md:block">Buka semua fasilitas &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fasilitas Card 1 -->
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1547082299-de196eaf2e78" alt="Lab Komputer" class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F]/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="inline-block p-2 bg-white/20 backdrop-blur-md rounded-lg mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase tracking-tight">Lab Komputer & Jaringan</h3>
                        <p class="text-gray-300 text-sm font-inter line-clamp-2">Fasilitas PC iMac dan jaringan fiber optic berkecepatan tinggi berstandar internasional.</p>
                    </div>
                    <button class="absolute top-6 right-6 w-10 h-10 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>

                <!-- Fasilitas Card 2 -->
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da" alt="Perpustakaan Digital" class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F]/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="inline-block p-2 bg-white/20 backdrop-blur-md rounded-lg mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </span>
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase tracking-tight">Perpustakaan Digital</h3>
                        <p class="text-gray-300 text-sm font-inter line-clamp-2">Ribuan koleksi e-book dan ruang baca yang nyaman serta estetik untuk literasi siswa.</p>
                    </div>
                    <button class="absolute top-6 right-6 w-10 h-10 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>

                <!-- Fasilitas Card 3 -->
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1518605368461-1e125222058c" alt="Gelanggang Olahraga" class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F]/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="inline-block p-2 bg-white/20 backdrop-blur-md rounded-lg mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2 2 2 0 012 2v.65M18 20.25a2 2 0 002-2V13.9a2 2 0 00-2-2 2 2 0 01-2-2v-3a2 2 0 00-2-2 2 2 0 01-2-2V4.5"></path></svg>
                        </span>
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase tracking-tight">Gelanggang Olahraga</h3>
                        <p class="text-gray-300 text-sm font-inter line-clamp-2">Fasilitas olahraga terpadu indoor untuk basket, futsal, dan voli berstandar kompetisi.</p>
                    </div>
                    <button class="absolute top-6 right-6 w-10 h-10 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
