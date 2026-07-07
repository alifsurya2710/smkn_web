@extends('layouts.landing')

@section('title', $album->title . ' - Galeri')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <!-- HEADER -->
    <section class="bg-white border-b border-slate-100 pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-6">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-[10px] font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-[0.3em] mb-12">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Media Center
            </a>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">{{ $album->category }}</span>
                        <span class="text-slate-300 font-bold tracking-widest text-[10px] uppercase">{{ $album->created_at->format('d M Y') }}</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-8">{{ $album->title }}</h1>
                    <p class="text-slate-500 text-lg md:text-xl font-medium leading-relaxed">
                        {{ $album->description ?? 'Menampilan dokumentasi kegiatan dari album ' . $album->title . ' SMKN 1 Katapang.' }}
                    </p>
                </div>
                
                <div class="flex-shrink-0">
                    <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100 flex items-center gap-6">
                        <div class="text-center">
                            <h4 class="text-3xl font-black text-slate-900 leading-none mb-1">{{ $album->photos->count() }}</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Photos</p>
                        </div>
                        <div class="w-[1px] h-10 bg-slate-200"></div>
                        <div class="text-center">
                            <h4 class="text-3xl font-black text-slate-900 leading-none mb-1">100%</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Documentation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GRID -->
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div id="album-gallery-container" class="w-full">
            <!-- GSAP Masonry will be injected here -->
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const photos = {!! json_encode($album->photos->map(function($p) use ($album) {
                return [
                    'id' => $p->id,
                    'img' => asset('storage/' . $p->image),
                    'category' => $album->category,
                    'title' => $album->title
                ];
            })) !!};

            new MasonryGallery('#album-gallery-container', {
                items: photos,
                animateFrom: 'center',
                stagger: 0.1,
                blurToFocus: true,
                colorShiftOnHover: true,
                gap: 24
            });
        });
    </script>

    <!-- FOOTER CTA -->
    <section class="max-w-5xl mx-auto px-6 pb-24">
        <div class="bg-slate-900 rounded-[3rem] p-16 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500 rounded-full blur-[80px] -ml-20 -mt-20"></div>
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-6">Browse More Albums?</h2>
                <a href="{{ route('gallery.index') }}" class="inline-flex bg-white text-slate-900 px-10 py-5 rounded-full text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-400 hover:text-white transition-all shadow-2xl">Return to Media Center</a>
            </div>
        </div>
    </section>
</div>
@endsection
