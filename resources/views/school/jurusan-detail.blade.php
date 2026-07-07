@extends('layouts.landing')

@section('title', $jurusan->name)

@section('content')
<div class="bg-[#0A142F] min-h-screen font-inter text-white overflow-hidden">
    <!-- HERO SECTION -->
    <section class="relative h-screen flex items-center justify-center p-4">
        <!-- Background Image with Ken Burns Effect -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ $jurusan->image ? asset('storage/'.$jurusan->image) : 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover animate-soft-zoom opacity-50" 
                 alt="{{ $jurusan->name }}">
            <!-- Cinematic Overlays -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-[#0A142F]"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto w-full px-6 lg:px-8">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-600/20 backdrop-blur-md rounded-full border border-blue-500/30 mb-8">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">{{ $jurusan->category ?? 'Program Keahlian' }}</span>
                </div>
                
                <h1 class="text-5xl sm:text-7xl md:text-9xl font-black mb-6 font-outfit uppercase leading-none tracking-tighter">
                    {{ explode(' ', $jurusan->name)[0] }}<span class="text-blue-500">{{ count(explode(' ', $jurusan->name)) > 1 ? ' ' . implode(' ', array_slice(explode(' ', $jurusan->name), 1)) : '' }}</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-300 font-medium leading-relaxed mb-6 max-w-2xl">
                    {{ $jurusan->tagline ?? $jurusan->name . ' (' . $jurusan->acronym . ')' }}
                </p>

                <p class="text-lg text-gray-400 mb-12 max-w-2xl line-clamp-3">
                    {{ $jurusan->description }}
                </p>

                <div class="flex flex-wrap gap-6">
                    <a href="#about" class="px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-2xl shadow-blue-600/30 transition-all transform hover:-translate-y-1 uppercase tracking-widest text-xs">Jelajahi Jurusan</a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3 grayscale opacity-30">
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Gulir</span>
            <div class="w-px h-16 bg-gradient-to-b from-white to-transparent"></div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-32 relative overflow-hidden bg-white text-[#0A142F]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="mb-12">
                        <div class="w-20 h-1.5 bg-[#0A142F] mb-8"></div>
                        <h2 class="text-4xl md:text-6xl font-black font-outfit uppercase tracking-tight mb-8">
                            Tentang {{ $jurusan->acronym }}
                        </h2>
                        <div class="prose prose-lg text-gray-600 font-inter leading-relaxed max-w-xl">
                            {!! nl2br(e($jurusan->detailed_description ?? $jurusan->description)) !!}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <div class="p-8 bg-gray-50 rounded-[2rem] border border-gray-100">
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2 block">Kepala Jurusan</span>
                            <p class="font-extrabold font-outfit">{{ $jurusan->head_of_major ?? 'TBA' }}</p>
                        </div>
                        <div class="p-8 bg-gray-50 rounded-[2rem] border border-gray-100">
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2 block">Kapasitas (Kuota)</span>
                            <p class="font-extrabold font-outfit">{{ $jurusan->seats > 0 ? $jurusan->seats . ' Siswa' : 'TBA' }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 relative" data-aos="fade-left">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl skew-y-1 hover:skew-y-0 transition-transform duration-700 aspect-video lg:aspect-square">
                        <img src="{{ $jurusan->about_image ? asset('storage/' . $jurusan->about_image) : ($jurusan->image ? asset('storage/' . $jurusan->image) : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1500') }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative back frame -->
                    <div class="absolute inset-0 bg-blue-600 rounded-[3rem] -translate-x-4 translate-y-4 -z-10 opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    @php
        $totalPhotos = $jurusan->albums->sum(fn($a) => $a->photos->count());
    @endphp
    <section class="py-32 bg-white text-[#0A142F]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up">
                <div>
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-blue-600 mb-6">Momen</h2>
                    <h3 class="text-4xl md:text-7xl font-black font-outfit uppercase leading-tight">Sorotan <br> Terbaru</h3>
                </div>
                <div class="mt-8 md:mt-0">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] bg-gray-50 px-4 py-2 rounded-full shadow-inner border border-gray-100">Total {{ $totalPhotos }} Foto</p>
                </div>
            </div>

            @if($totalPhotos > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($jurusan->albums as $album)
                        @foreach($album->photos->take(4) as $photo)
                        <div class="group relative aspect-square rounded-[2rem] overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <img src="{{ asset('storage/' . $photo->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/40 transition-all duration-500 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <i class="fas fa-expand text-white text-2xl"></i>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            @else
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200" data-aos="fade-up">
                    <div class="w-20 h-20 bg-white shadow-sm text-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-gray-500 font-outfit text-lg font-medium mb-2">Belum ada momen tertangkap</p>
                    <p class="text-gray-400 text-sm max-w-sm mx-auto">Foto-foto kegiatan dan galeri terkait program keahlian ini akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- OTHER MAJORS SECTION -->
    <section class="py-32 bg-[#FBFCFE]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Jelajahi Lebih Lanjut</div>
                <h3 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase tracking-tight">Program Keahlian Lainnya</h3>
                <p class="text-gray-400 max-w-2xl mx-auto font-inter text-lg">Temukan potensi diri Anda melalui berbagai pilihan program keahlian unggulan kami lainnya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($otherMajors as $other)
                <div class="group relative bg-white border border-gray-100 rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-[480px]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <!-- major Image -->
                    <div class="h-1/2 relative overflow-hidden">
                        <img src="{{ $other->image ? (Str::startsWith($other->image, 'http') ? $other->image : asset('storage/'.$other->image)) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                        
                        <!-- Top Badge -->
                        <div class="absolute top-6 left-6">
                            <div class="px-3 py-1 bg-blue-600 rounded-full text-[10px] font-bold text-white uppercase tracking-widest shadow-lg">
                                {{ $other->category ?? 'UNGGULAN' }}
                            </div>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="p-8 flex-1 flex flex-col justify-between relative bg-white">
                        <!-- Acronym Background Shadow -->
                        <div class="absolute top-4 right-8 text-7xl font-black text-gray-50 pointer-events-none group-hover:text-blue-50 transition-all duration-700">
                            {{ $other->acronym }}
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-2xl font-extrabold text-[#0A142F] mb-3 font-outfit uppercase group-hover:text-blue-600 transition-colors tracking-tight">
                                {{ $other->name }}
                            </h3>
                            <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-2">
                                {{ $other->description ?? 'Membentuk tenaga kerja profesional and kompeten di bidangnya dengan standar industri global.' }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-50 mt-auto relative z-10">
                            <a href="{{ route('jurusan.detail', $other->slug) }}" class="text-[11px] font-extrabold text-[#0A142F] uppercase tracking-[0.2em] group-hover:text-blue-600 transition-all flex items-center gap-2">
                                PELAJARI &rarr;
                            </a>
                            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">DEPARTEMEN {{ $other->acronym }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-20 text-center" data-aos="zoom-in">
                <a href="{{ route('jurusan.index') }}" class="inline-flex justify-center items-center px-10 py-4 bg-white border-2 border-gray-100 hover:border-blue-600 hover:text-blue-600 text-[#0A142F] font-extrabold rounded-2xl shadow-sm transition-all text-xs uppercase tracking-widest">
                    Lihat Semua Jurusan
                </a>
            </div>
        </div>
    </section>

    <!-- NEWS & UPDATES SECTION -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl md:text-5xl font-black text-[#0A142F] font-outfit uppercase tracking-tight mb-4">Berita & <span class="text-blue-600">Pembaruan</span></h2>
                    <p class="text-gray-500 font-inter">Informasi dan berita terbaru dari program keahlian {{ $jurusan->name }}.</p>
                </div>
                <a href="{{ route('berita.index') }}" class="mt-6 md:mt-0 text-[10px] bg-blue-50 text-blue-600 px-6 py-3 rounded-xl font-bold uppercase tracking-widest flex items-center gap-2 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                    Lihat Semua Berita
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($relatedNews as $post)
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-gray-100 group hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="h-56 relative overflow-hidden">
                        <img src="{{ $post->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 rounded-xl bg-white/90 backdrop-blur-md text-[#0A142F] text-[10px] font-black uppercase tracking-widest shadow-sm">
                                {{ $post->category ?? 'Berita' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-2 text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                        <h3 class="text-xl font-extrabold text-[#0A142F] mb-4 font-outfit leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $post->title }}
                        </h3>
                        <a href="{{ route('berita.detail', $post->slug) }}" class="text-[10px] font-black text-[#0A142F] hover:text-blue-600 transition-all uppercase tracking-widest flex items-center gap-2">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-[2rem] border border-gray-100 shadow-sm" data-aos="fade-up">
                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 font-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-inter font-medium">Belum ada berita atau update untuk program keahlian ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection
