@extends('layouts.landing')

@section('title', 'Prestasi Siswa')

@section('content')
<!-- Hero Section -->
<div class="relative h-[40vh] min-h-[300px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Prestasi Hero">
        <div class="absolute inset-0 bg-[#0A142F]/80 mix-blend-multiply"></div>
    </div>
    
    <div class="relative z-10 text-center px-4" data-aos="zoom-in">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 font-outfit uppercase tracking-tight">Prestasi & Penghargaan</h1>
        <nav class="flex justify-center space-x-2 text-gray-300 text-sm font-medium uppercase tracking-widest font-inter">
            <a href="{{ route('home') }}" class="hover:text-white transition">HOME</a>
            <span>&raquo;</span>
            <span class="text-white">PRESTASI</span>
        </nav>
    </div>
</div>

<!-- Achievements Grid -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Pencapaian Unggulan</div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] font-outfit uppercase">Kebanggaan SMKN 1 Katapang</h2>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto font-inter">Berikut adalah daftar prestasi yang telah diraih oleh siswa-siswi terbaik kami dalam berbagai bidang kompetisi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($achievements as $achievement)
                 <a href="{{ route('prestasi.detail', $achievement->id) }}" class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 group flex flex-col hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    <div class="h-56 relative overflow-hidden">
                        <img src="{{ $achievement->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F]/80 via-[#0A142F]/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md text-[#0A142F] text-[10px] font-bold px-3 py-1 rounded-full border border-white/20 uppercase tracking-widest shadow-sm">{{ $achievement->category->name ?? 'PRESTASI' }}</span>
                        <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0 text-[10px] font-bold uppercase tracking-widest">
                            Detail &rarr;
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-extrabold text-gray-900 group-hover:text-blue-600 text-lg font-outfit leading-tight transition-colors line-clamp-3 mb-4">{{ $achievement->title }}</h3>
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                            <span>{{ $achievement->year }}</span>
                            <span class="text-blue-600 group-hover:underline">BACA SELENGKAPNYA</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center" data-aos="fade-up">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 font-outfit">Belum Ada Prestasi</h3>
                    <p class="text-gray-500 font-inter">Data prestasi sedang dalam proses input data.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $achievements->links() }}
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-[#0A142F] relative overflow-hidden">
    <!-- Decoration -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow-400/10 rounded-full blur-3xl -ml-48 -mb-48"></div>

    
    </div>
</section>
@endsection
