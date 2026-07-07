@extends('layouts.landing')

@section('title', $extra->name)

@section('content')
<div class="bg-[#0A142F] min-h-screen font-inter text-white overflow-hidden">
    <!-- HERO SECTION -->
    <section class="relative h-screen flex items-center justify-center p-4">
        <!-- Background Image with Ken Burns Effect -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ $extra->image_url }}" 
                 class="w-full h-full object-cover animate-soft-zoom opacity-50" 
                 alt="{{ $extra->name }}">
            <!-- Cinematic Overlays -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-[#0A142F]"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto w-full px-6 lg:px-8">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-600/20 backdrop-blur-md rounded-full border border-blue-500/30 mb-8">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">{{ $extra->category }}</span>
                </div>
                
                <h1 class="text-6xl md:text-9xl font-black mb-6 font-outfit uppercase leading-none tracking-tighter">
                    {{ explode(' ', $extra->name)[0] }}<span class="text-blue-500">{{ count(explode(' ', $extra->name)) > 1 ? ' ' . implode(' ', array_slice(explode(' ', $extra->name), 1)) : '' }}</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-300 font-medium leading-relaxed mb-12 max-w-2xl">
                    {{ $extra->description }}
                </p>

                <div class="flex flex-wrap gap-6">
                    <a href="#about" class="px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-2xl shadow-blue-600/30 transition-all transform hover:-translate-y-1 uppercase tracking-widest text-xs">Explore Club</a>
                    @if($extra->social_links)
                        @foreach($extra->social_links as $platform => $url)
                            <a href="{{ $url }}" target="_blank" class="w-16 h-16 flex items-center justify-center bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl backdrop-blur-md transition-all">
                                <i class="fab fa-{{ $platform }} text-xl"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3 grayscale opacity-30">
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Scroll</span>
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
                            {{ $extra->about_title ?? 'About Our Club' }}
                        </h2>
                        <div class="prose prose-lg text-gray-600 font-inter leading-relaxed max-w-xl">
                            {!! nl2br(e($extra->about_description ?? 'This club is dedicated to developing students skills and building character through teamwork and discipline.')) !!}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <div class="p-8 bg-gray-50 rounded-[2rem] border border-gray-100">
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2 block">Mentor</span>
                            <p class="font-extrabold font-outfit">{{ $extra->mentor ?? 'TBA' }}</p>
                        </div>
                        <div class="p-8 bg-gray-50 rounded-[2rem] border border-gray-100">
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2 block">Schedule</span>
                            <p class="font-extrabold font-outfit">{{ $extra->schedule ?? 'Weekly' }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 relative" data-aos="fade-left">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl skew-y-1 hover:skew-y-0 transition-transform duration-700 aspect-video lg:aspect-square">
                        <img src="{{ $extra->about_image ? asset('storage/' . $extra->about_image) : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1500' }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative back frame -->
                    <div class="absolute inset-0 bg-blue-600 rounded-[3rem] -translate-x-4 translate-y-4 -z-10 opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACHIEVEMENTS SECTION -->
    <section class="py-24 bg-[#0A142F] relative overflow-hidden text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-5xl font-light font-outfit uppercase tracking-widest mb-4">Prestasi Kami</h2>
                <p class="text-gray-400 font-inter">Our journey of excellence captured in gold and silver.</p>
            </div>

            @if($extra->achievements->count() > 0)
            <div class="relative" x-data="{
                scrollPrev() {
                    $refs.slider.scrollBy({ left: -400, behavior: 'smooth' });
                },
                scrollNext() {
                    $refs.slider.scrollBy({ left: 400, behavior: 'smooth' });
                }
            }">
                <!-- Left Arrow -->
                <button @click="scrollPrev" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-12 flex items-center justify-center w-12 h-12 text-gray-400 hover:text-white transition-colors z-10 hidden md:flex">
                    <svg class="w-8 h-8 font-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <!-- Slider -->
                <div x-ref="slider" class="flex overflow-x-auto snap-x snap-mandatory gap-6 md:gap-8 pb-8 px-4 -mx-4 md:mx-0" style="scrollbar-width: none; -ms-overflow-style: none;">
                    <style>
                        .flex.overflow-x-auto::-webkit-scrollbar { display: none; }
                    </style>
                    
                    @foreach($extra->achievements as $achievement)
                    <a href="{{ route('prestasi.detail', $achievement->id) }}" class="shrink-0 w-[85vw] sm:w-[400px] md:w-[450px] snap-center group relative rounded-[2rem] overflow-hidden bg-white/5 border border-white/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="aspect-[4/3] w-full relative">
                            <img src="{{ $achievement->image_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $achievement->title }}">
                            
                            <!-- Simple Text Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F]/90 via-[#0A142F]/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <h4 class="text-lg md:text-xl font-bold font-inter mb-1 text-white uppercase italic leading-tight">{{ $achievement->title }}</h4>
                                <div class="flex items-center gap-4">
                                    <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">{{ $achievement->year }}</span>
                                    <span class="text-[9px] font-bold text-white/40 uppercase tracking-[0.2em] group-hover:text-white transition-colors">Click for Details &rarr;</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <!-- Right Arrow -->
                <button @click="scrollNext" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-12 flex items-center justify-center w-12 h-12 text-gray-400 hover:text-white transition-colors z-10 hidden md:flex">
                    <svg class="w-8 h-8 font-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
            @else
            <div class="text-center py-12 border border-white/10 rounded-[2rem] bg-white/5 backdrop-blur-sm" data-aos="fade-up">
                <i class="fas fa-trophy text-4xl text-gray-600 mb-4 opacity-50"></i>
                <p class="text-gray-400 italic">Belum ada data prestasi yang tercatat untuk ekstrakurikuler ini.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- GALLERY SECTION -->
    @php
        $totalPhotos = $extra->albums->sum(fn($a) => $a->photos->count());
    @endphp
    @if($totalPhotos > 0)
    <section class="py-32 bg-white text-[#0A142F]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-24" data-aos="fade-up">
                <div>
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-blue-600 mb-6">Moments</h2>
                    <h3 class="text-4xl md:text-7xl font-black font-outfit uppercase">Recent <br> Highlights</h3>
                </div>
                <div class="mt-8 md:mt-0">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Total {{ $totalPhotos }} Captures</p>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($extra->albums as $album)
                    @foreach($album->photos->take(4) as $photo)
                    <div class="group relative aspect-square rounded-3xl overflow-hidden cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <img src="{{ $photo->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/40 transition-all duration-500 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <i class="fas fa-expand text-white text-2xl"></i>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- OTHER EXTRACURRICULARS -->
    @if($others->count() > 0)
    <section class="py-32 bg-[#FBFCFE] overflow-hidden border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h3 class="text-4xl md:text-6xl font-black text-[#0A142F] mb-6 font-outfit uppercase tracking-tight italic">Ekskul Lainnya</h3>
                <p class="text-gray-400 max-w-2xl mx-auto font-inter text-lg font-medium leading-relaxed">
                    Eksplorasi bakat dan minatmu melalui berbagai program ekstrakurikuler unggulan kami lainnya.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($others as $other)
                <div class="group relative bg-white border border-gray-100 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 flex flex-col h-[520px]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <!-- Thumbnail Area -->
                    <div class="h-1/2 relative overflow-hidden">
                        <img src="{{ $other->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-40"></div>
                        
                        <!-- Top Badge -->
                        <div class="absolute top-6 left-6">
                            <div class="px-4 py-1.5 bg-blue-600/90 backdrop-blur-md rounded-full text-[8px] font-black text-white uppercase tracking-widest shadow-xl">
                                {{ $other->category }}
                            </div>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="p-10 flex-1 flex flex-col justify-between relative bg-white">
                        <!-- Decorative Name Initial -->
                        <div class="absolute top-4 right-8 text-8xl font-black text-gray-50 pointer-events-none group-hover:text-blue-50 transition-all duration-700 uppercase italic">
                            {{ substr($other->name, 0, 2) }}
                        </div>

                        <div class="relative z-10">
                            <h4 class="text-2xl font-black text-[#0A142F] mb-4 font-outfit uppercase group-hover:text-blue-600 transition-colors tracking-tight leading-tight">
                                {{ $other->name }}
                            </h4>
                            <p class="text-gray-400 text-sm font-medium leading-relaxed line-clamp-3">
                                {{ $other->description }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between pt-8 border-t border-gray-50 mt-auto relative z-10">
                            <a href="{{ route('extracurriculars.show', $other->slug) }}" class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] flex items-center gap-2 group-hover:gap-4 transition-all">
                                EXPLORE <span class="text-xl leading-none">&rarr;</span>
                            </a>
                            <span class="text-[8px] font-bold text-gray-300 uppercase tracking-widest uppercase">SMKN 1 KATAPANG</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 text-center" data-aos="zoom-in">
                <a href="{{ route('extracurriculars.index') }}" class="inline-flex justify-center items-center px-12 py-5 bg-white border-2 border-gray-100 hover:border-blue-600 hover:text-blue-600 text-[#0A142F] font-black rounded-2xl shadow-sm transition-all text-[10px] uppercase tracking-[0.3em] group">
                    <span class="group-hover:-translate-x-1 transition-transform">Lihat</span> Semua Ekskul
                </a>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
