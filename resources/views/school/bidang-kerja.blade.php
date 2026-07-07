@extends('layouts.landing')

@section('title', $title)

@section('content')
<!-- Hero Section -->
<div class="relative h-[45vh] min-h-[350px] flex items-center justify-center overflow-hidden bg-[#0A142F]">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="{{ isset($settings[str_replace('-', '_', $slug) . '_image']) ? asset('storage/' . $settings[str_replace('-', '_', $slug) . '_image']) : 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=2070&auto=format&fit=crop' }}" class="w-full h-full object-cover animate-soft-zoom grayscale-[20%]" alt="{{ $title }}">
        <div class="absolute inset-0 bg-[#0A142F]/85 backdrop-blur-[1px] mix-blend-multiply"></div>
    </div>
    
    <div class="relative z-10 text-center px-4" data-aos="zoom-in">
        <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-600/20 backdrop-blur-md rounded-full border border-blue-500/30 mb-6">
            <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">Hubungan Masyarakat</span>
        </div>
        <h1 class="text-4xl md:text-7xl font-black text-white mb-6 font-outfit uppercase tracking-tighter">{{ $title }}</h1>
        <nav class="flex justify-center space-x-2 text-gray-400 text-[10px] font-bold uppercase tracking-[0.3em] font-inter">
            <a href="{{ route('home') }}" class="hover:text-white transition">BERANDA</a>
            <span>/</span>
            <span class="text-white">BIDANG KERJA</span>
        </nav>
    </div>
</div>

@if($slug === 'hubungan-industri')
<!-- Specialized Hubungan Industri Page -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mb-24 items-center">
            <div data-aos="fade-right">
                <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-4">Industrial Link & Match</div>
                <h2 class="text-3xl md:text-5xl font-black text-[#0A142F] mb-8 font-outfit uppercase leading-tight tracking-tight">Sinergi Dunia Pendidikan & <span class="text-blue-600">Industri</span></h2>
                <div class="prose prose-lg text-gray-600 font-inter leading-relaxed max-w-xl">
                    Hubungan Industri SMK Negeri 1 Katapang berfokus pada penyelarasan kurikulum sekolah dengan kebutuhan industri modern (Link and Match). Kami menjalin kerja sama strategis untuk memastikan setiap lulusan memiliki kompetensi yang relevan dan siap kerja.
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" data-aos="fade-left">
                <div class="p-8 bg-[#F8FAFC] rounded-[2rem] border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-bold text-[#0A142F] uppercase tracking-wider mb-2">Bursa Kerja Khusus</h4>
                    <p class="text-xs text-slate-500 font-medium">Layanan penempatan kerja dan informasi lowongan bagi alumni.</p>
                </div>
                <div class="p-8 bg-[#F8FAFC] rounded-[2rem] border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h4 class="font-bold text-[#0A142F] uppercase tracking-wider mb-2">Prakerin (PKL)</h4>
                    <p class="text-xs text-slate-500 font-medium">Praktik langsung di industri partner untuk mengasah keterampilan siswa.</p>
                </div>
                <div class="p-8 bg-[#F8FAFC] rounded-[2rem] border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-[#0A142F] uppercase tracking-wider mb-2">Kunjungan Industri</h4>
                    <p class="text-xs text-slate-500 font-medium">Eksposur dini siswa terhadap lingkungan dan budaya kerja industri.</p>
                </div>
                <div class="p-8 bg-[#F8FAFC] rounded-[2rem] border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-[#0A142F] uppercase tracking-wider mb-2">Uji Kompetensi</h4>
                    <p class="text-xs text-slate-500 font-medium">Sertifikasi kemahiran siswa yang diakui secara nasional & industri.</p>
                </div>
            </div>
        </div>

        <!-- Partners Grid -->
        <div class="mb-20">
            <div class="text-center mb-16" data-aos="fade-up">
                <h3 class="text-[10px] font-black uppercase tracking-[0.5em] text-blue-600 mb-4">Mitra Industri Kami</h3>
                <h2 class="text-3xl md:text-5xl font-black text-[#0A142F] font-outfit uppercase tracking-tight">Jejaring Tanpa <span class="text-blue-600">Batas</span></h2>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
                @foreach($partners as $partner)
                    <div class="flex items-center justify-center p-6 bg-white border border-slate-100 rounded-3xl hover:border-blue-600 hover:shadow-2xl hover:shadow-blue-600/10 transition-all group grayscale hover:grayscale-0" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 12) * 50 }}">
                        <div class="text-center">
                            @if($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="max-h-12 w-auto object-contain mx-auto mb-2 opacity-60 group-hover:opacity-100 transition-opacity">
                            @endif
                            <span class="text-[10px] md:text-[11px] font-black text-[#0A142F] uppercase tracking-tighter group-hover:text-blue-600 transition-colors leading-tight block">
                                {{ $partner->name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        
    </div>
</section>

@else
<!-- Standard Bidang Kerja Page -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div data-aos="fade-right">
                <div class="aspect-[4/3] rounded-[2rem] overflow-hidden shadow-2xl relative">
                    <img src="{{ isset($settings[str_replace('-', '_', $slug) . '_image']) ? asset('storage/' . $settings[str_replace('-', '_', $slug) . '_image']) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop' }}" class="w-full h-full object-cover" alt="{{ $title }}">
                    <div class="absolute inset-0 border-4 border-white/20 rounded-[2rem] pointer-events-none"></div>
                </div>
            </div>
            <div data-aos="fade-left">
                <div class="flex items-center space-x-2 text-blue-600 mb-6">
                    <div class="w-12 h-1 bg-blue-600 rounded-full"></div>
                    <span class="text-sm font-bold uppercase tracking-[0.2em]">BIDANG KERJA</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#0A142F] mb-6 font-outfit uppercase leading-tight">
                    {{ $title }}
                </h2>
                <div class="text-gray-600 leading-relaxed font-inter space-y-4">
                    @if(isset($settings[str_replace('-', '_', $slug) . '_text']) && !empty($settings[str_replace('-', '_', $slug) . '_text']))
                        {!! nl2br(e($settings[str_replace('-', '_', $slug) . '_text'])) !!}
                    @else
                        <p>Penjelasan mengenai <strong class="text-gray-900">{{ $title }}</strong> sedang dalam proses penyusunan konten oleh tim terkait.</p>
                        <p>Bagian ini akan segera diperbarui dengan informasi detail fungsionalitas, struktur, serta tugas pokok dari bidang kerja ini. Silakan kembali lagi nanti untuk membaca pembaruan yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

