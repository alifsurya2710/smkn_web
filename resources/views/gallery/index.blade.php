@extends('layouts.landing')

@section('title', 'Media Center - Galeri & Dokumentasi')

@section('content')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
<div class="bg-slate-50 min-h-screen pb-24">
    <!-- HERO SECTION -->
    <section class="relative bg-[#0F172A] pt-32 pb-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500 rounded-full blur-[120px] -mr-64 -mt-64"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500 rounded-full blur-[120px] -ml-64 -mb-64"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h6 class="text-blue-400 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">SMKN 1 KATAPANG</h6>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight mb-8">
                    Media Album <br/> & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400 italic">Gallery</span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl font-medium leading-relaxed mb-12">
                    Relive the best moments from our school activities, sports competitions, and academic ceremonies.
                </p>

                <!-- Filter Bar -->
                <div class="flex flex-wrap gap-3 mt-12 bg-white/5 backdrop-blur-md p-2 rounded-[2rem] border border-white/10 w-fit">
                    @php $categories = ['All', 'Events', 'Sports', 'Academic', 'Excursions']; @endphp
                    @foreach($categories as $cat)
                    <a href="{{ route('gallery.index', ['category' => $cat]) }}" 
                       class="px-8 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all 
                              {{ ($category ?? 'All') == $cat ? 'bg-white text-slate-900 shadow-xl' : 'text-white/60 hover:text-white' }}">
                        {{ $cat }} {{ $cat == 'All' ? 'Albums' : '' }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED ALBUMS -->
    @if($featuredAlbums->count() > 0)
    <section class="max-w-7xl mx-auto px-6 -mt-12 relative z-20">
        <div class="flex items-end justify-between mb-10">
            <h2 class="text-sm font-black text-slate-400 uppercase tracking-[0.4em] ml-2">Featured Albums</h2>
            <div class="h-[2px] flex-1 mx-8 bg-slate-200/50"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredAlbums as $album)
            <a href="{{ route('gallery.album', $album->slug) }}" class="group relative aspect-[4/3] rounded-[2.5rem] overflow-hidden bg-slate-200 border border-slate-100 shadow-xl shadow-slate-200/50 transition-all hover:-translate-y-2">
                <img src="{{ asset('storage/' . $album->cover_image) }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-10 w-full translate-y-4 group-hover:translate-y-0 transition-transform">
                    <div class="flex items-center gap-3 mb-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="px-3 py-1 bg-blue-500 text-white text-[8px] font-black uppercase tracking-widest rounded-full">{{ $album->category }}</span>
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[8px] font-black uppercase tracking-widest rounded-full">Featured</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2 leading-tight group-hover:text-blue-400 transition-colors">{{ $album->title }}</h3>
                    <div class="flex items-center gap-6 text-[10px] font-bold text-white/50 uppercase tracking-widest">
                        <span class="flex items-center gap-2">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $album->created_at->format('M d, Y') }}
                        </span>
                        <span class="flex items-center gap-2 text-white/70">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $album->photos_count }} Photos
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- YOUTUBE VIDEO TIMELINE -->
    @if($youtubeVideos->count() > 0)
    <section class="max-w-7xl mx-auto px-6 pt-24">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-4">
                    <span class="p-3 bg-red-600 rounded-2xl text-white shadow-xl shadow-red-500/20">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </span>
                    Youtube Timeline
                </h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-4 ml-16">Eksplorasi kegiatan sekolah melalui lensa video resmi SMKN 1 Katapang.</p>
            </div>
            
            <a href="https://youtube.com/@smkn1katapang" target="_blank" class="hidden md:flex items-center gap-3 px-6 py-3 bg-white border border-slate-200 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:text-red-600 hover:border-red-600 transition-all shadow-sm">
                Subscribe Channel
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="relative group">
            <div class="flex overflow-x-auto gap-6 pb-8 snap-x no-scrollbar">
                @foreach($youtubeVideos as $video)
                <div class="min-w-[320px] md:min-w-[420px] snap-start group/card">
                    <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-slate-900 shadow-2xl shadow-slate-200/50 group-hover/card:-translate-y-2 transition-all duration-500">
                        <img src="{{ $video->thumbnail_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110 opacity-80 group-hover/card:opacity-100">
                        <div class="absolute inset-0 bg-black/40 group-hover/card:bg-black/20 transition-all flex items-center justify-center">
                            <a href="https://youtube.com/watch?v={{ $video->youtube_id }}" target="_blank" class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center text-white shadow-2xl shadow-red-600/40 hover:scale-110 transition-transform cursor-pointer">
                                <svg class="h-8 w-8 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </a>
                        </div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-lg font-bold text-white mb-1 line-clamp-1 group-hover/card:text-red-100 transition-colors">{{ $video->title }}</h3>
                            <p class="text-[10px] font-bold text-white/60 lowercase tracking-wider line-clamp-1 italic">{{ $video->description ?: 'YouTube Official Content' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- RECENT GALLERY MASONRY -->
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Recent Gallery</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">A collection of individual highlights from all events.</p>
            </div>
            <div class="flex gap-2">
                 <button class="p-4 bg-white rounded-2xl border border-slate-100 shadow-sm text-slate-900 hover:bg-slate-50 transition-all">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                 </button>
            </div>
        </div>

        <div id="recent-gallery-container" class="w-full">
            <!-- GSAP Masonry will be injected here -->
        </div>

        <div class="mt-20 flex justify-center">
            @if($photos->hasPages())
                {{ $photos->links() }}
            @else
                <button class="px-12 py-5 bg-white border border-slate-200 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] text-slate-900 hover:bg-slate-900 hover:text-white transition-all shadow-xl shadow-slate-200/50">Load More Photos</button>
            @endif
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const photos = {!! json_encode($photos->map(function($p) {
            return [
                'id' => $p->id,
                'img' => asset('storage/' . $p->image),
                'url' => $p->album ? route('gallery.album', $p->album->slug) : '#',
                'category' => $p->category,
                'title' => $p->album ? $p->album->title : 'Untitled Photo'
            ];
        })) !!};

        new MasonryGallery('#recent-gallery-container', {
            items: photos,
            animateFrom: 'bottom',
            stagger: 0.05,
            blurToFocus: true,
            colorShiftOnHover: true,
            gap: 24
        });
    });
</script>
@endsection
